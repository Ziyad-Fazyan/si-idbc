@extends('admin.layout')

@section('title', 'Edit Landing Page Content')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit {{ Str::title(str_replace('_', ' ', $content->section)) }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('web-admin.master.landing-page.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $content->title }}">
                </div>

                @if($content->section !== 'hero_slider')
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="5">{{ $content->content }}</textarea>
                </div>
                @endif

                <div class="form-group">
                    <label for="image">Image</label>
                    @if($content->image_path)
                        <div class="mb-2">
                            <img src="{{ asset($content->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-height: 200px">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                @if($content->section === 'hero_slider' || $content->section === 'mission')
                <div class="form-group">
                    <label>Additional Content</label>
                    <div id="additional-content">
                        @if($content->section === 'hero_slider')
                            @foreach($content->additional_content ?? [] as $index => $slide)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <input type="text" name="additional_content[{{ $index }}][title]" class="form-control mb-2" placeholder="Slide Title" value="{{ $slide['title'] ?? '' }}">
                                    <input type="text" name="additional_content[{{ $index }}][subtitle]" class="form-control" placeholder="Slide Subtitle" value="{{ $slide['subtitle'] ?? '' }}">
                                </div>
                            </div>
                            @endforeach
                        @elseif($content->section === 'mission')
                            @foreach($content->additional_content['points'] ?? [] as $index => $point)
                            <div class="input-group mb-2">
                                <input type="text" name="additional_content[points][]" class="form-control" value="{{ $point }}">
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-sm btn-info" onclick="addMissionPoint()">Add Point</button>
                        @endif
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ $content->order }}">
                </div>

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $content->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Content</button>
                <a href="{{ route('web-admin.master.landing-page.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function addMissionPoint() {
    const container = document.getElementById('additional-content');
    const newPoint = document.createElement('div');
    newPoint.className = 'input-group mb-2';
    newPoint.innerHTML = `
        <input type="text" name="additional_content[points][]" class="form-control" placeholder="New Mission Point">
        <div class="input-group-append">
            <button type="button" class="btn btn-danger" onclick="this.parentElement.parentElement.remove()">Remove</button>
        </div>
    `;
    container.insertBefore(newPoint, container.lastElementChild);
}
</script>
@endpush
@endsection
