@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Lihat Ticket
@endsection
@section('urlmenu')
    {{ route('mahasiswa.support.ticket-index') }}
@endsection
@section('custom-css')
@endsection
@section('subdesc')
    Halaman untuk melihat Ticket #{{ $ticket->code }}
@endsection
@section('content')
    <section class="min-h-screen bg-gray-50 p-4 md:p-8">
        <!-- Reply Form -->
        <form action="{{ route('mahasiswa.support.ticket-store-reply', $ticket->code) }}" method="POST"
            enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            @csrf

            <!-- Card Header -->
            <div class="bg-[#0C6E71] px-6 py-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl font-semibold text-white">
                        Lihat @yield('menu')
                    </h2>
                    <a href="@yield('urlmenu')"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md flex items-center space-x-1 transition-colors mt-2 md:mt-0">
                        <i class="fa-solid fa-backward"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 space-y-4">
                <!-- Ticket Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Student Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mahasiswa</label>
                        <input type="text" readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>

                    <!-- Department -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Departement</label>
                        <input type="text" readonly value="{{ $ticket->dept_id }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>

                    <!-- Priority Level -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Level Prioritas</label>
                        <input type="text" readonly value="{{ $ticket->prio_id }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>
                </div>

                <!-- Subject and Status -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" readonly value="{{ $ticket->subject }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <input type="text" readonly value="{{ $ticket->stat_id }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>
                </div>

                <!-- Message Editor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Balasan Anda</label>
                    <textarea name="message" id="summernote" rows="8"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                        placeholder="Tulis balasan Anda di sini..."></textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#FF6B35] hover:bg-[#E05D2E] text-white px-6 py-2 rounded-md flex items-center space-x-2 transition-colors">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kirim Balasan</span>
                    </button>
                </div>
            </div>
        </form>

        <!-- Conversation Thread -->
        <div class="space-y-4" id="support-container">
            <!-- Existing Replies -->
            @foreach ($support as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- User Info -->
                            <div class="md:w-1/4">
                                <div class="flex items-start space-x-3">
                                    @if ($item->users_id !== null)
                                        <img src="{{ asset('storage/images/' . $item->users->mhs_image) }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-[#0C6E71]">
                                        <div>
                                            <p class="font-semibold">{{ $item->users->mhs_name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                            <p class="text-xs text-gray-400">Kelas: 
                                                @forelse($item->users->kelas as $kelas)
                                                    {{ $kelas->name }}@if(!$loop->last), @endif
                                                @empty
                                                    Tidak ada kelas
                                                @endforelse
                                            </p>
                                        </div>
                                    @elseif ($item->admin_id !== null)
                                        <img src="{{ asset('storage/images/' . $item->admin->image) }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-[#0C6E71]">
                                        <div>
                                            <p class="font-semibold">{{ $item->admin->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                            <p class="text-xs text-gray-400">{{ $item->admin->type }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3 flex space-x-2">
                                    <button class="text-red-500 hover:text-red-700 text-sm flex items-center">
                                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Message Content -->
                            <div class="md:w-3/4">
                                <div class="prose max-w-none">
                                    {!! $item->message !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Original Ticket -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- User Info -->
                        <div class="md:w-1/4">
                            <div class="flex items-start space-x-3">
                                <img src="{{ asset('storage/images/' . $ticket->users->mhs_image) }}"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-[#0C6E71]">
                                <div>
                                    <p class="font-semibold">{{ $ticket->users->mhs_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                                    <p class="text-xs text-gray-400">Kelas: 
                                        @forelse($ticket->users->kelas as $kelas)
                                            {{ $kelas->name }}@if(!$loop->last), @endif
                                        @empty
                                            Tidak ada kelas
                                        @endforelse
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Content -->
                        <div class="md:w-3/4">
                            <div class="prose max-w-none">
                                {!! $ticket->message !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        let autoRefreshTimer; // Timer untuk auto-refresh

        // Fungsi untuk memulai auto-refresh setiap 5 detik
        function startAutoRefresh() {
            autoRefreshTimer = setInterval(function() {
                // Lakukan refresh halaman
                location.reload();
            }, 15000); // Refresh setiap 5 detik
        }

        // Fungsi untuk menghentikan auto-refresh
        function stopAutoRefresh() {
            if (autoRefreshTimer) {
                clearInterval(autoRefreshTimer);
            }
        }

        // Memulai auto-refresh secara default
        startAutoRefresh();

        // Menangani event ketika pengguna mulai mengetik di summernote
        $('#summernote').on('summernote.keyup', function() {
            stopAutoRefresh(); // Menghentikan auto-refresh saat pengguna mengetik
        });

        // Menangani event ketika pengguna berhenti mengetik di summernote
        $('#summernote').on('summernote.blur', function() {
            startAutoRefresh(); // Mengaktifkan kembali auto-refresh saat pengguna berhenti mengetik
        });
    </script>
@endsection
