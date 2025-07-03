<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Helpers\RoleTrait;
use App\Models\SiteManage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings\WebSettings;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LandingPageController extends Controller
{
    use RoleTrait;

    public function index()
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::find(1);
        $data['contents'] = SiteManage::orderBy('order')->paginate(15);
        return view('user.sitemanager.landing.index', $data);
    }

    public function edit($id)
    {
        $data['prefix'] = $this->setPrefix();
        $data['web'] = WebSettings::where('id', 1)->first();
        $data['content'] = SiteManage::findOrFail($id);
        return view('user.sitemanager.landing.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $content = SiteManage::findOrFail($id);

        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'additional_content' => 'nullable|array',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
        ]);

        // Upload gambar utama
        if ($request->hasFile('image')) {
            if (!Storage::disk('public')->exists('images/landing')) {
                Storage::disk('public')->makeDirectory('images/landing');
            }
            if ($content->image_path) {
                $oldPath = str_replace('storage/', '', $content->image_path);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('images/landing', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        // Ambil data additional_content lama
        $oldAdditional = is_array($content->additional_content)
            ? $content->additional_content
            : json_decode($content->additional_content, true) ?? [];

        // Handle additional content: hanya replace bagian yang ada di form, sisanya tetap
        if (isset($data['additional_content'])) {
            $data['additional_content'] = $this->mergeAdditionalContentSmart($request, $data['additional_content'], $oldAdditional);
        } else {
            // Jika form tidak kirim additional_content, tetap pakai data lama
            $data['additional_content'] = $oldAdditional;
        }

        unset($data['image']);
        $content->update($data);

        Alert::success('Success', 'Landing page content updated successfully');
        return redirect()->route('web-admin.landing-page.index');
    }

    // Helper: konversi nama input array ke dot notation (additional_content[points][0][image] => additional_content.points.0.image)
    private function arrayInputToDot($inputName)
    {
        return preg_replace(['/\[/','/\]/'], ['.',''], $inputName);
    }

    // Merge additional_content: hanya replace bagian yang ada di form, sisanya tetap
    private function mergeAdditionalContentSmart(Request $request, $new, $old, $prefix = 'additional_content')
    {
        foreach ($new as $key => &$value) {
            $inputName = $prefix . '[' . $key . ']';
            if (is_array($value)) {
                $isNumeric = array_keys($value) === range(0, count($value) - 1);
                if ($isNumeric) {
                    foreach ($value as $idx => &$item) {
                        if (is_array($item)) {
                            $item = $this->mergeAdditionalContentSmart($request, $item, $old[$key][$idx] ?? [], $inputName . "[$idx]");
                        }
                    }
                    $value = array_values($value);
                } else {
                    $value = $this->mergeAdditionalContentSmart($request, $value, $old[$key] ?? [], $inputName);
                }
            } else {
                // Handle image: akses file dengan dot notation
                if ($key === 'image_path' || str_ends_with($key, '_image')) {
                    $dotPath = $this->arrayInputToDot($inputName);
                    $file = $request->file($dotPath);
                    if ($file) {
                        if (!Storage::disk('public')->exists('images/landing')) {
                            Storage::disk('public')->makeDirectory('images/landing');
                        }
                        if ($file->isValid()) {
                            $path = $file->store('images/landing', 'public');
                            $value = 'storage/' . $path;
                        }
                    } elseif ($request->has($dotPath . '_old')) {
                        $value = $request->input($dotPath . '_old');
                    } elseif (isset($old[$key])) {
                        $value = $old[$key];
                    } else {
                        $value = null;
                    }
                } elseif (isset($old[$key]) && empty($value)) {
                    $value = $old[$key];
                }
            }
        }
        $isNumeric = array_keys($new) === range(0, count($new) - 1);
        if (!$isNumeric) {
            foreach ($old as $key => $oldValue) {
                if (!array_key_exists($key, $new)) {
                    $new[$key] = $oldValue;
                }
            }
        }
        return $new;
    }

    // Proses additional_content tanpa merge lama, hanya dari form
    private function processAdditionalContentSimple(Request $request, $array, $prefix = 'additional_content')
    {
        foreach ($array as $key => &$value) {
            $inputName = $prefix . '[' . $key . ']';
            if (is_array($value)) {
                // Reindex jika array numerik
                if (array_keys($value) === range(0, count($value) - 1)) {
                    foreach ($value as $idx => &$item) {
                        if (is_array($item)) {
                            $item = $this->processAdditionalContentSimple($request, $item, $inputName . "[$idx]");
                        }
                    }
                    $value = array_values($value);
                } else {
                    $value = $this->processAdditionalContentSimple($request, $value, $inputName);
                }
            } else {
                // Handle image: jika tidak upload baru, ambil dari *_old
                if ($key === 'image_path' || str_ends_with($key, '_image')) {
                    $fileInputName = str_replace(['.', '[', ']'], ['_', '', ''], $inputName);
                    if ($request->hasFile($fileInputName)) {
                        if (!Storage::disk('public')->exists('images/landing')) {
                            Storage::disk('public')->makeDirectory('images/landing');
                        }
                        $file = $request->file($fileInputName);
                        if ($file->isValid()) {
                            $path = $file->store('images/landing', 'public');
                            $value = 'storage/' . $path;
                        }
                    } elseif ($request->has($fileInputName . '_old')) {
                        $value = $request->input($fileInputName . '_old');
                    } else {
                        $value = null;
                    }
                }
            }
        }
        return $array;
    }

    // Tambahkan fungsi bantu untuk reindex array numerik
    private function reindexNumericArrays($array)
    {
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                if (array_keys($value) === range(0, count($value) - 1)) {
                    $value = array_map(function($item) {
                        return is_array($item) ? $this->reindexNumericArrays($item) : $item;
                    }, array_values($value));
                } else {
                    $value = $this->reindexNumericArrays($value);
                }
            }
        }
        return $array;
    }
}
