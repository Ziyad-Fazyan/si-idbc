@extends('base.base-dash-index')
@section('title')
    Dashboard Admin - Internal Developer
@endsection
@section('menu')
    Dashboard
@endsection
@section('submenu')
    Edit Landing Content
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Edit {{ Str::title(str_replace('_', ' ', $content->section)) }} content for the landing page
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-gray-800">Edit
                            {{ Str::title(str_replace('_', ' ', $content->section)) }} Content</h2>
                        <a href="{{ route($prefix . 'landing-page.index') }}"
                            class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Back
                        </a>
                    </div>
                    <div class="p-6">
                        <form action="{{ route($prefix . 'landing-page.update', $content->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                <input type="text" name="title" id="title"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $content->title }}" placeholder="Enter section title">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($content->section !== 'hero_slider')
                                <div class="mb-6">
                                    <label for="content"
                                        class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                    <textarea name="content" id="content" rows="5"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Enter main content">{{ $content->content }}</textarea>
                                    @error('content')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                                @if ($content->image_path)
                                    <img src="{{ asset($content->image_path) }}" alt="Current Image"
                                        class="mb-2 rounded-md border border-gray-200 max-h-48">
                                @else
                                    <span class="text-gray-500 text-sm">No image uploaded</span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Update
                                    Image</label>
                                <div class="mt-1 flex items-center">
                                    <input type="file" name="image" id="image"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Leave blank to keep current image</p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            @if (!empty($content->additional_content))
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Additional Content</label>
                                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                        @php
                                            function renderAdditionalContent($data, $namePrefix = 'additional_content') {
                                                foreach ($data as $key => $value) {
                                                    $inputName = $namePrefix . '[' . (is_string($key) ? $key : $key) . ']';
                                                    if (is_array($value)) {
                                                        // Check if this is a list of arrays (e.g. points)
                                                        $isListOfArrays = true;
                                                        foreach ($value as $subValue) {
                                                            if (!is_array($subValue)) {
                                                                $isListOfArrays = false;
                                                                break;
                                                            }
                                                        }
                                                        if ($isListOfArrays) {
                                                            echo '<div class="mb-4 pl-4 border-l-2 border-indigo-200">';
                                                            echo '<label class="block font-medium text-gray-700 mb-2">' .
                                                                ucfirst(str_replace('_', ' ', $key)) .
                                                                '</label>';
                                                            foreach ($value as $index => $subArray) {
                                                                echo '<div class="mb-4 pl-4 border-l-2 border-indigo-300">';
                                                                echo '<label class="block font-semibold text-gray-600 mb-1">Item ' .
                                                                    ((int)$index + 1) .
                                                                    '</label>';
                                                                renderAdditionalContent($subArray, $inputName . "[$index]");
                                                                echo '</div>';
                                                            }
                                                            echo '</div>';
                                                        } else {
                                                            echo '<div class="mb-4 pl-4 border-l-2 border-indigo-200">';
                                                            echo '<label class="block font-medium text-gray-700 mb-2">' .
                                                                ucfirst(str_replace('_', ' ', $key)) .
                                                                '</label>';
                                                            renderAdditionalContent($value, $inputName);
                                                            echo '</div>';
                                                        }
                                                    } else {
                                                        if (
                                                            $key === 'image_path' &&
                                                            // filter_var($value, FILTER_VALIDATE_URL) === false &&
                                                            !empty($value)
                                                        ) {
                                                            // Show current image preview and file input to change image
                                                            echo '<div class="mb-4">';
                                                            echo '<label class="block text-xs text-gray-500 mb-1">' .
                                                                ucfirst(str_replace('_', ' ', $key)) .
                                                                '</label>';
                                                            echo '<img src="' .
                                                                asset($value) .
                                                                '" alt="Current Image" class="mb-2 rounded-md border border-gray-300 max-h-24">';
                                                            echo '<input type="file" name="' .
                                                                $inputName .
                                                                '" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">';
                                                            // Hidden input to keep old value if not changed
                                                            echo '<input type="hidden" name="' . $inputName . '_old" value="' . e($value) . '">';
                                                            echo '</div>';
                                                        } else {
                                                            echo '<div class="mb-3">';
                                                            echo '<label class="block text-xs text-gray-500 mb-1">' .
                                                                ucfirst(str_replace('_', ' ', $key)) .
                                                                '</label>';
                                                            echo '<input type="text" name="' .
                                                                $inputName .
                                                                '" value="' . e($value) . '" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="' . ucfirst(str_replace('_', ' ', $key)) . '">';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }
                                            }
                                            renderAdditionalContent($content->additional_content);
                                        @endphp
                                    </div>
                                </div>
                            @endif

                            <div class="mb-6">
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Display
                                    Order</label>
                                <input type="number" name="order" id="order" min="1"
                                    class="w-20 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                    value="{{ $content->order }}">
                                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center">
                                    <input type="checkbox" id="is_active" name="is_active" value="1"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                        {{ $content->is_active ? 'checked' : '' }}>
                                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active (Visible on
                                        website)</label>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                                <button type="reset"
                                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Reset
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Update Content
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-800">Content Preview</h3>
                    </div>
                    <div class="p-6">
                        <div class="prose max-w-none">
                            <h4 class="text-lg font-semibold mb-2">{{ $content->title }}</h4>
                            @if ($content->section !== 'hero_slider')
                                <p class="text-gray-600 mb-4">{{ $content->content }}</p>
                            @endif
                            @if ($content->image_path)
                                <div class="mb-4">
                                    <img src="{{ asset($content->image_path) }}" alt="Preview"
                                        class="rounded-md max-w-full h-auto">
                                </div>
                            @endif
                            @if (!empty($content->additional_content))
                                <div class="space-y-3">
                                    @php
                                        function renderPreviewContent($data)
                                        {
                                            foreach ($data as $key => $value) {
                                                if (is_array($value)) {
                                                    // Check if this is an array of arrays (list of items)
                                                    $isListOfArrays = true;
                                                    foreach ($value as $subValue) {
                                                        if (!is_array($subValue)) {
                                                            $isListOfArrays = false;
                                                            break;
                                                        }
                                                    }
                                                    if ($isListOfArrays) {
                                                        echo '<div class="pl-4 border-l-2 border-gray-200">';
                                                        echo '<h5 class="font-medium">' .
                                                            ucfirst(str_replace('_', ' ', $key)) .
                                                            '</h5>';
                                                        echo '<ul class="list-disc pl-5 space-y-1">';
                                                        foreach ($value as $item) {
                                                            echo '<li>';
                                                            renderPreviewContent($item);
                                                            echo '</li>';
                                                        }
                                                        echo '</ul>';
                                                        echo '</div>';
                                                    } else {
                                                        echo '<div>';
                                                        echo '<span class="font-medium">' .
                                                            ucfirst(str_replace('_', ' ', $key)) .
                                                            ':</span> ';
                                                        echo '<span class="text-gray-600 ml-1">';
                                                        renderPreviewContent($value);
                                                        echo '</span>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<div>';
                                                    echo '<span class="font-medium">' .
                                                        ucfirst(str_replace('_', ' ', $key)) .
                                                        ':</span> ';
                                                    echo '<span class="text-gray-600 ml-1">' . e($value) . '</span>';
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                        renderPreviewContent($content->additional_content);
                                    @endphp
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
