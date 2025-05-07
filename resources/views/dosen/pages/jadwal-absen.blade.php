@extends('base.base-dash-index')
@section('menu')
    Jadwal Mengajar
@endsection
@section('submenu')
    Verifikasi Absen
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.jadwal-index') }}
@endsection
@section('subdesc')
    Halaman untuk memverifikasi absen
@endsection
@section('title')
    @yield('submenu') - @yield('menu') - Siakad By Internal Developer
@endsection
@section('content')
<section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Card Header -->
            <div class="bg-[#0C6E71] px-6 py-4 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">
                    @yield('menu') - @yield('submenu')
                </h2>
                <a href="@yield('urlmenu')" class="bg-[#FF6B35] hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
            
            <!-- Card Body -->
            <div class="p-4 md:p-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-[#E4E2DE]">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">NIM Mahasiswa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">Nama Mahasiswa</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($absen as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ $item->mahasiswa->mhs_nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ $item->mahasiswa->mhs_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $item->absen_type === 'Hadir' ? 'bg-green-100 text-green-800' : 
                                       ($item->absen_type === 'Izin' ? 'bg-blue-100 text-blue-800' : 
                                       'bg-red-100 text-red-800') }}">
                                    {{ $item->absen_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                                <button onclick="openModal('updateAbsen{{ $item->code }}')" class="text-[#0C6E71] hover:text-teal-700 mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Template (You'll need to implement one for each item) -->
<div id="modalTemplate" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        
        <!-- Modal content -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <!-- Modal content goes here -->
                <h3 class="text-lg leading-6 font-medium text-[#2E2E2E] mb-4">Edit Absensi</h3>
                <!-- Form elements would go here -->
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#FF6B35] text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Simpan
                </button>
                <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Simple modal handling
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    function closeModal() {
        document.querySelectorAll('[id^="updateAbsen"]').forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.classList.remove('overflow-hidden');
    }
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
            closeModal();
        }
    }
</script>
@endsection
    <div class="me-1 mb-1 d-inline-block">

        <!--Extra Large Modal -->
        @foreach ($absen as $item)
            <form action="{{ route('dosen.akademik.jadwal-absen-update', $item->code) }}" method="POST"
                enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="modal fade text-left w-100" id="updateAbsen{{ $item->code }}" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel16" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel16">Edit Absensi Perkuliahan -
                                    {{ $item->mahasiswa->mhs_name }} </h4>
                                <div class="">

                                    <button type="submit" class="btn btn-outline-primary mt-1">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger mt-1" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-control col-lg-12 col-12">
                                        <img src="{{ asset('storage/images/' . $item->absen_proof) }}"
                                            class="card-img-top mb-2" alt="">
                                        <label for="absen_desc">Deskripsi Absen</label>
                                        <textarea name="absen_desc" id="absen_desc" class="form-control" cols="30" rows="10"
                                            placeholder="Inputkan deskripsi absen...">{{ $item->absen_desc == null ? null : $item->absen_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
@endsection
