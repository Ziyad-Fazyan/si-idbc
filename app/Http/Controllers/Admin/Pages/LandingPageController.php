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
        $data['web'] = WebSettings::where('id', 1)->first();
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

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($content->image_path) {
                Storage::delete($content->image_path);
            }
            
            $path = $request->file('image')->store('public/images/landing');
            $data['image_path'] = $path;
        }

        $content->update($data);
        Alert::success('Success', 'Landing page content updated successfully');
        return redirect()->route('web-admin.landing-page.index');
    }
}
