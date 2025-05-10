@extends('base.base-dash-index')
@section('title')
    Data Kampus
@endsection
@section('menu')
    Data Kampus
@endsection
@section('submenu')
    Modifikasi Data Kampus
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk data Kampus
@endsection
@section('content')
    <section class="p-4">
        <form action="{{ route($prefix . 'system.setting-update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-800">Edit Logo Kampus</h4>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="p-4 space-y-4">
                            <a href="#" class="block">
                                <img src="{{ asset('storage/images/' . $web->school_logo) }}"
                                    class="w-full h-auto rounded-lg" alt="Logo Kampus">
                            </a>
                            <hr class="border-gray-200">
                            <div class="space-y-2">
                                <label for="school_logo" class="block text-sm font-medium text-gray-700">Logo Kampus</label>
                                <input type="file" name="school_logo" id="school_logo"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-800">Modifikasi @yield('menu')</h4>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="space-y-2">
                                <label for="school_name" class="block text-sm font-medium text-gray-700">Nama
                                    Sekolah</label>
                                <input type="text" name="school_name" id="school_name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    value="{{ $web->school_name }}" placeholder="Inputkan nama sekolah...">
                                @error('school_name')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="school_apps" class="block text-sm font-medium text-gray-700">Nama
                                    Aplikasi</label>
                                <input type="text" name="school_apps" id="school_apps"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    value="{{ $web->school_apps }}" placeholder="Inputkan nama aplikasi...">
                                @error('school_apps')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="school_head" class="block text-sm font-medium text-gray-700">Nama Rektor / Ketua
                                    Institusi</label>
                                <input type="text" name="school_head" id="school_head"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    value="{{ $web->school_head }}"
                                    placeholder="Inputkan nama rektor / kepala institusi...">
                                @error('school_head')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="school_desc" class="block text-sm font-medium text-gray-700">Kata
                                    Sambutan</label>
                                <textarea name="school_desc" id="dark"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    rows="5" placeholder="Inputkan pesan sambutan...">{{ $web->school_desc }}</textarea>
                                @error('school_desc')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="school_link" class="block text-sm font-medium text-gray-700">Link Website
                                    Sekolah</label>
                                <input type="text" name="school_link" id="school_link"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    value="{{ $web->school_link }}" placeholder="Inputkan link website sekolah...">
                                @error('school_link')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="school_phone" class="block text-sm font-medium text-gray-700">No
                                        Telepon</label>
                                    <input type="text" name="school_phone" id="school_phone"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        value="{{ $web->school_phone }}" placeholder="Inputkan nomor telepon sekolah...">
                                    @error('school_phone')
                                        <small class="text-[#FF6B35]">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label for="school_email" class="block text-sm font-medium text-gray-700">Alamat
                                        Email</label>
                                    <input type="text" name="school_email" id="school_email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        value="{{ $web->school_email }}" placeholder="Inputkan alamat email sekolah...">
                                    @error('school_email')
                                        <small class="text-[#FF6B35]">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 gap-4 mt-4">
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800">Pengaturan Website</h4>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div id="alertPlaceholder"></div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="branch" class="block text-sm font-medium text-gray-700">Branch Channel</label>
                            <div class="flex items-center space-x-2">
                                <select name="branch" id="branch"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Update Channel</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch['name'] }}">{{ $branch['name'] }}</option>
                                    @endforeach
                                </select>
                                <button
                                    class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300"
                                    id="syncButton">
                                    <i class="fa-solid fa-sync"></i>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <form action="{{ route('web-admin.system.database-import') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="sqldata" class="block text-sm font-medium text-gray-700">Import / Export &
                                    Reset Database ( .sql )</label>
                                <div class="flex items-center space-x-2">
                                    <input type="file" name="sqldata" id="sqldata"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <button type="submit"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                        <i class="fa-solid fa-upload"></i>
                                    </button>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#databaseReset"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                                        <i class="fa-solid fa-sync"></i>
                                    </a>
                                    <a href="{{ route('web-admin.system.database-export') }}"
                                        class="inline-flex items-center justify-center px-3 py-2 border border-green-500 text-green-500 rounded-md hover:bg-green-500 hover:text-white transition-colors duration-300">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800">Data Identitas Kampus</h4>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
                <div class="p-4">
                    Coming Soon
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Reset Database -->
    <div class="modal fade" id="databaseReset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-l">
            <div class="modal-content rounded-lg shadow-lg">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Reset Database</h4>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300"
                                data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="text-center">
                                <p class="font-bold text-red-500">Peringatan !!!</p>
                                <p>Aksi ini akan mereset semua database anda.</p>
                                <p>Silahkan inputkan <span class="font-bold">Secret Key</span> untuk melanjutkan</p>
                            </div>
                            <div class="space-y-2">
                                <label for="secret" class="block text-sm font-medium text-gray-700">Secret Keys</label>
                                <input type="text" name="secret" id="secret"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                @error('secret')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="text-sm text-gray-600">
                                <p>Note:</p>
                                <ol class="list-decimal list-inside space-y-1">
                                    <li>Semua data dibersihkan, hanya menyisakan data default saja.</li>
                                    <li>Secret Key dapat dilihat pada .env.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script>
        document.getElementById("school_logo").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const refreshBranchesBtn = document.getElementById('xxxx');
            refreshBranchesBtn.addEventListener('click', function(event) {
                event.preventDefault();
                location.reload(); // Simply reload the page to refresh branches
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const syncButton = document.getElementById('syncButton');
            const branchSelect = document.getElementById('branch');
            const alertPlaceholder = document.getElementById('alertPlaceholder');

            syncButton.addEventListener('click', function(event) {
                event.preventDefault();

                fetch('{{ route('web-admin.system.website-check') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alertPlaceholder.innerHTML = '';
                        if (data.message.includes('There is an update available')) {
                            const alertDiv = document.createElement('div');
                            alertDiv.className =
                                'bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4';
                            alertDiv.innerHTML =
                                `${data.message} <a href="#" id="updateNow" class="text-yellow-700 underline">Update Now</a>`;
                            alertPlaceholder.appendChild(alertDiv);

                            document.getElementById('updateNow').addEventListener('click', function(e) {
                                e.preventDefault();
                                const selectedBranch = branchSelect.value;

                                fetch('{{ route('web-admin.system.website-update') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({
                                            branch: selectedBranch
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(updateData => {
                                        alertPlaceholder.innerHTML = '';
                                        const updateAlertDiv = document.createElement(
                                        'div');
                                        updateAlertDiv.className = updateData.status ===
                                            'success' ?
                                            'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4' :
                                            'bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4';
                                        updateAlertDiv.innerHTML = updateData.message;
                                        alertPlaceholder.appendChild(updateAlertDiv);
                                    });
                            });
                        } else {
                            const alertDiv = document.createElement('div');
                            alertDiv.className =
                                'bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4';
                            alertDiv.textContent = data.message;
                            alertPlaceholder.appendChild(alertDiv);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endsection
