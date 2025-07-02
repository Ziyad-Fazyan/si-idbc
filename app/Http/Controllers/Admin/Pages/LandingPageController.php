<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteManage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LandingPageController extends Controller
{
    public function index()
    {
        $contents = SiteManage::orderBy('order')->get();
        return view('admin.pages.landing-page.index', compact('contents'));
    }

    public function edit($id)
    {
        $content = SiteManage::findOrFail($id);
        return view('admin.pages.landing-page.edit', compact('content'));
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
