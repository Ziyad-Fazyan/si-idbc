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
            // Pastikan folder ada
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

        // Handle additional content
        if (isset($data['additional_content'])) {
            $oldAdditional = is_array($content->additional_content)
                ? $content->additional_content
                : json_decode($content->additional_content, true) ?? [];

            $processed = $this->processAdditionalContent($request, $data['additional_content'], $oldAdditional);
            $data['additional_content'] = $processed;
        }

        unset($data['image']);
        $content->update($data);

        Alert::success('Success', 'Landing page content updated successfully');
        return redirect()->route('web-admin.landing-page.index');
    }

    private function processAdditionalContent(Request $request, array $newContent, array $oldContent)
    {
        foreach ($newContent as $key => &$value) {
            if (is_array($value)) {
                // Jika ini adalah array dalam array (misalnya points)
                if (array_key_exists($key, $oldContent) && is_array($oldContent[$key])) {
                    $value = $this->processAdditionalContent($request, $value, $oldContent[$key]);
                } else {
                    $value = $this->processAdditionalContent($request, $value, []);
                }
            } else {
                // Handle image uploads
                if ($key === 'image' || str_ends_with($key, '_image')) {
                    $inputName = str_replace(['.', '[', ']'], ['_', '', ''], "additional_content.$key");

                    if ($request->hasFile($inputName)) {
                        // Pastikan folder ada
                        if (!Storage::disk('public')->exists('images/landing')) {
                            Storage::disk('public')->makeDirectory('images/landing');
                        }

                        $file = $request->file($inputName);
                        if ($file->isValid()) {
                            // Hapus file lama jika ada
                            if (isset($oldContent[$key]) && !empty($oldContent[$key])) {
                                $oldImage = str_replace('storage/', '', $oldContent[$key]);
                                Storage::disk('public')->delete($oldImage);
                            }

                            $path = $file->store('images/landing', 'public');
                            $value = 'storage/' . $path;
                        }
                    } elseif (isset($oldContent[$key])) {
                        // Pertahankan gambar lama jika tidak ada upload baru
                        $value = $oldContent[$key];
                    }
                } elseif (isset($oldContent[$key]) && empty($value)) {
                    // Pertahankan nilai lama jika nilai baru kosong
                    $value = $oldContent[$key];
                }
            }
        }

        // Gabungkan dengan konten lama untuk field yang tidak ada di request
        foreach ($oldContent as $key => $oldValue) {
            if (!array_key_exists($key, $newContent)) {
                $newContent[$key] = $oldValue;
            }
        }

        return $newContent;
    }
}
