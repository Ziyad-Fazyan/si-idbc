@extends('base.base-dash-index')
@section('title')
    Absensi Harian - Siakad By Internal Developer
@endsection

@section('menu')
    Absensi Harian
@endsection

@section('submenu')
    Lihat
@endsection

@section('urlmenu')
    {{ route($prefix . 'presensi.absen-harian') }}
@endsection

@section('subdesc')
    Halaman untuk melihat data absensi harian
@endsection

@section('custom-css')
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .modal {
            transition: opacity 0.25s ease;
        }

        .modal-backdrop {
            transition: opacity 0.25s ease;
        }
    </style>
@endsection

@section('content')
    <section class="p-4 lg:p-6">
        
        <!-- Statistics Cards -->
        @include('user.pages.partials.statisticscard')

        <!-- Main Content Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h4 class="text-xl font-semibold text-gray-800">Absensi Harian</h4>
                <a href="@yield('urlmenu')" class="bg-[#FF6B35] hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                    <i class="fa-solid fa-backward mr-2"></i>Kembali
                </a>
            </div>

            <div class="p-6">
                <form action="{{ route($prefix . 'home-presensi-update-absen') }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Hidden User ID -->
                        <input type="hidden" name="absen_user_id" value="{{ Auth::user()->id }}">

                        <!-- User Name -->
                        <div class="space-y-2">
                            <label for="absen_user_name" class="block text-sm font-medium text-gray-700">Nama User</label>
                            <input type="text"
                                   name="absen_user_name"
                                   id="absen_user_name"
                                   readonly
                                   value="{{ Auth::user()->name }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                        </div>

                        <!-- Jenis Absen -->
                        <div class="space-y-2">
                            <label for="absen_type" class="block text-sm font-medium text-gray-700">Jenis Absen</label>
                            <select name="absen_type"
                                    id="absen_type"
                                    readonly
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                <optgroup label="Absen Harian">
                                    <option value="" selected>Pilih Jenis Absen</option>
                                    <option value="0" {{ $absen->absen_raw_type == 0 ? 'selected' : '' }}>
                                        Absen Regular ( 08.00 - 16.00 )
                                    </option>
                                    <option value="1" {{ $absen->absen_raw_type == 1 ? 'selected' : '' }}>
                                        Absen Lembur ( 16.00 - 21.00 )
                                    </option>
                                </optgroup>
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div class="space-y-2">
                            <label for="absen_date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date"
                                   name="absen_date"
                                   id="absen_date"
                                   readonly
                                   value="{{ $absen->absen_date }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                            @error('absen_date')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Jam Masuk -->
                        <div class="space-y-2">
                            <label for="absen_time_in" class="block text-sm font-medium text-gray-700">Jam Masuk</label>
                            <input type="time"
                                   name="absen_time_in"
                                   id="absen_time_in"
                                   readonly
                                   value="{{ $absen->absen_time_in }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                            @error('absen_time_in')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Jam Keluar -->
                        <div class="space-y-2">
                            <label for="absen_time_out" class="block text-sm font-medium text-gray-700">Jam Keluar</label>
                            <input type="time"
                                   name="absen_time_out"
                                   id="absen_time_out"
                                   value="{{ $absen->absen_time_out == null ? now()->format('H:i:s') : $absen->absen_time_out }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                            @error('absen_time_out')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Pekerjaan Hari Ini -->
                    <div class="mt-6 space-y-2">
                        <label for="absen_desc" class="block text-sm font-medium text-gray-700">Pekerjaan Hari Ini</label>
                        <textarea name="absen_desc"
                                  id="absen_desc"
                                  rows="6"
                                  placeholder="Jelaskan aktivitas kamu hari ini ya..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent resize-none">{{ $absen->absen_desc }}</textarea>
                        @error('absen_desc')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                                class="bg-[#0C6E71] hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition-colors duration-200 flex items-center space-x-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Add smooth scroll effect for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card-hover');

        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Auto-focus on time out field if it's empty
        const timeOutField = document.getElementById('absen_time_out');
        if (timeOutField && !timeOutField.value) {
            timeOutField.focus();
        }

        // Auto-resize textarea
        const textarea = document.getElementById('absen_desc');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        }
    });
</script>
@endpush
