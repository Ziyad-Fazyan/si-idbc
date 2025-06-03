@extends('base.base-dash-index')
@section('title')
    Data Postingan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Postingan
@endsection
@section('submenu')
    Edit Postingan
@endsection
@section('submenu0')
    Edit Postingan - {{ $post->name }}
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Postingan
@endsection
@section('custom-css')
    <link href="https://cdn.bootcdn.net/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/@wangeditor/editor@latest/dist/css/style.css" rel="stylesheet">

    <style>
        html.light {
            --w-e-textarea-bg-color: #333;
            --w-e-textarea-color: #fff;
        }

        #editor—wrapper {
            border: 1px solid #ccc;
            z-index: 100;
            /* If you need */
        }

        #toolbar-container {
            border-bottom: 1px solid #ccc;
        }

        #editor-container {
            height: 500px;
        }
    </style>
@endsection
@section('content')
    <section class="py-4">
        <div class="w-full">
            <form action="{{ route('web-admin.news.post-update', $post->code) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="bg-white light:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 light:border-gray-700 flex justify-between items-center">
                        <h5 class="text-xl font-semibold text-gray-700 light:text-gray-200">@yield('submenu')</h5>
                        <div>
                            <a href="{{ route('web-admin.news.post-index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                                <i class="fa-solid fa-backward mr-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Image Upload Section -->
                        <div class="md:col-span-4">
                            <div class="space-y-4">
                                <div class="aspect-w-16 aspect-h-9 bg-gray-100 light:bg-gray-700 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/images/' . $post->image) }}" class="w-full h-auto object-cover" alt="Post Cover Preview">
                                </div>
                                
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Post Cover</label>
                                    <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 light:file:bg-gray-700 light:file:text-gray-200 light:hover:file:bg-gray-600 light:text-gray-300" name="image" id="image" accept="image/*">
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Fields Section -->
                        <div class="md:col-span-8 space-y-4">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Kategori Postingan</label>
                                <select name="category_id" id="category_id" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white">
                                    <option value="" selected>Pilih Kategori</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ $post->category_id === $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Judul Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="name" id="name" value="{{ $post->name }}" placeholder="Inputkan judul postingan...">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="keywords" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Kata Kunci Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="keywords" id="keywords" value="{{ $post->keywords }}" placeholder="Inputkan kata kunci postingan...">
                                @error('keywords')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="metadesc" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Meta Desc Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="metadesc" id="metadesc" value="{{ $post->metadesc }}" placeholder="Inputkan meta deskripsi postingan...">
                                @error('metadesc')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Content Editor Section -->
                        <div class="md:col-span-12 space-y-4">
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Isi Konten Postingan</label>
                                <div class="border border-gray-300 light:border-gray-600 rounded-md overflow-hidden">
                                    <div id="editor—wrapper" class="w-full">
                                        <div id="toolbar-container" class="border-b border-gray-300 light:border-gray-600"><!-- toolbar --></div>
                                        <div id="editor-container" class="min-h-[500px]"><!-- editor --></div>
                                    </div>
                                </div>
                                <textarea id="editor-content" name="content" style="display: none;">{!! $post->content !!}</textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                    <i class="fa-solid fa-paper-plane mr-2"></i> Submit Post
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('custom-js')
    <script>
        document.getElementById("image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script src="https://unpkg.com/@wangeditor/editor@latest/dist/index.js"></script>
    <script src="https://unpkg.com/@wangeditor/editor@latest/dist/i18n/en.js"></script> <!-- Tambahkan ini -->
    <script>
    const { createEditor, createToolbar, i18nChangeLanguage } = window.wangEditor

    // Ganti bahasa ke Inggris
    i18nChangeLanguage('en')

    const editorConfig = {
        placeholder: 'Type here...',
        MENU_CONF: {
          uploadImage: {
            fieldName: 'filed',
            base64LimitSize: 10 * 1024 * 1024 // 10M 以下插入 base64
          }
        },
        onChange(editor) {
          const html = editor.getHtml()
          document.getElementById('editor-content').value = html
        }
    }



    // Mengambil nilai konten awal dari textarea yang tersembunyi
    const initialContent = document.getElementById('editor-content').value;

    const editor = createEditor({
        selector: '#editor-container',
        html: initialContent,
        // html: '<p><br></p>',
        config: editorConfig,
        mode: 'default', // or 'simple'
    })

    const toolbarConfig = {}

    const toolbar = createToolbar({
        editor,
        selector: '#toolbar-container',
        config: toolbarConfig,
        mode: 'default', // or 'simple'
    })
    </script>
    <script>
        const E = window.wangEditor

        // Ganti bahasa editor
        // const LANG = location.href.indexOf('lang=en') > 0 ? 'en' : 'zh-CN'
        E.i18nChangeLanguage('en')
        // Mengambil nilai konten awal dari textarea yang tersembunyi
        const initialContent = document.getElementById('editor-content').value;

        window.editor = E.createEditor({
            selector: '#editor-container',
            html: initialContent,
            config: {
                placeholder: 'Type here...',
                MENU_CONF: {
                    uploadImage: {
                        fieldName: 'your-fileName',
                        base64LimitSize: 10 * 1024 * 1024 // 10M 以下插入 base64
                    }
                },
                onChange(editor) {
                    const html = editor.getHtml()
                    document.getElementById('editor-content').value = html
                }
            }
        })



        window.toolbar = E.createToolbar({
            editor,
            selector: '#toolbar-container',
            config: {}
        })
    </script>
@endsection
