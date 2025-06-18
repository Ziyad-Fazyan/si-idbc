@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Buka Ticket Support
@endsection
@section('urlmenu')
    {{ route('mahasiswa.support.ticket-index') }}
@endsection
@section('subdesc')
    Halaman untuk membuka ticket support
@endsection
@section('custom-css')
    <!-- Custom CSS section for additional styles if needed -->
@endsection
@section('content')
    <!-- Main container with consistent padding -->
    <div class="container mx-auto px-4 py-6">
        <!-- Ticket creation form -->
        <form action="{{ route('mahasiswa.support.ticket-store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-4xl mx-auto">
            @csrf

            <!-- Form card with shadow and rounded corners -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Card header with border and background -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <!-- Ticket icon for consistency -->
                            <i class="fas fa-ticket-alt text-blue-600 mr-2"></i>
                            @yield('menu')
                        </h2>
                        <!-- Back button with icon -->
                        <a href="@yield('urlmenu')"
                            class="inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors mt-2 sm:mt-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>

                <!-- Form body with spacing -->
                <div class="p-6 space-y-6">
                    <!-- Grid layout for form inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Student name input -->
                        <div class="space-y-2">
                            <label for="mhs_name" class="block text-sm font-medium text-gray-800">Nama Mahasiswa</label>
                            <input type="text" name="mhs_name" id="mhs_name"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                                value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}" readonly>
                            @error('mhs_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Department select -->
                        <div class="space-y-2">
                            <label for="dept_id" class="block text-sm font-medium text-gray-800">Pilih Departement</label>
                            <select name="dept_id" id="dept_id"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                                <option value="">Pilih Departement Tujuan</option>
                                <option value="1" {{ $dept == 1 ? 'selected' : '' }}>Departement Finance</option>
                                <option value="2" {{ $dept == 2 ? 'selected' : '' }}>Departement Absen</option>
                                <option value="3" {{ $dept == 3 ? 'selected' : '' }}>Departement Akademik</option>
                                <option value="4" {{ $dept == 4 ? 'selected' : '' }}>Departement Musyrif</option>
                                <option value="5" {{ $dept == 5 ? 'selected' : '' }}>Departement Support</option>
                                <option value="6" {{ $dept == 6 ? 'selected' : '' }}>Departement Site Manager</option>
                            </select>
                            @error('dept_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Priority level select -->
                        <div class="space-y-2">
                            <label for="prio_id" class="block text-sm font-medium text-gray-800">Level Prioritas</label>
                            <select name="prio_id" id="prio_id"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                                <option value="">Pilih Prioritas</option>
                                <option value="0">Rendah</option>
                                <option value="1">Medium</option>
                                <option value="2">Tinggi</option>
                                <option value="3">Urgent</option>
                            </select>
                            @error('prio_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject input -->
                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-medium text-gray-800">Subject</label>
                        <input type="text" name="subject" id="subject" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                            placeholder="Inputkan subject ticket...">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message textarea -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-medium text-gray-800">Message</label>
                        <textarea name="message" id="summernote" cols="30" rows="10"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 min-h-[200px]"></textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit button container -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send Ticket
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- JavaScript for priority level color coding -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prioritySelect = document.getElementById('prio_id');
            if (prioritySelect) {
                prioritySelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    this.classList.remove('border-red-300', 'border-yellow-300', 'border-green-300',
                        'border-orange-500');
                    this.classList.add('border-gray-200');

                    switch (selectedOption.value) {
                        case '0':
                            this.classList.add('border-green-400');
                            break;
                        case '1':
                            this.classList.add('border-yellow-400');
                            break;
                        case '2':
                            this.classList.add('border-orange-500');
                            break;
                        case '3':
                            this.classList.add('border-red-500');
                            break;
                    }
                });

                prioritySelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
