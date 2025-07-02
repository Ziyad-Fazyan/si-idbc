@extends('admin.layout')

@section('title', 'Landing Page Content Management')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Landing Page Content</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Title</th>
                            <th>Content Preview</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contents as $content)
                        <tr>
                            <td>{{ Str::title(str_replace('_', ' ', $content->section)) }}</td>
                            <td>{{ $content->title }}</td>
                            <td>{{ Str::limit($content->content, 100) }}</td>
                            <td>
                                @if($content->image_path)
                                    <img src="{{ asset($content->image_path) }}" alt="Preview" class="img-thumbnail" style="max-height: 50px">
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $content->is_active ? 'success' : 'danger' }}">
                                    {{ $content->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('web-admin.master.landing-page.edit', $content->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
