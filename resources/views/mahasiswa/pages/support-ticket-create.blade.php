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
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] py-8 px-4 sm:px-6 lg:px-8">
        <form action="{{ route('mahasiswa.support.ticket-store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto">
            @csrf

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-6 py-4 border-b border-[#E4E2DE]">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-white">
                            @yield('menu')
                        </h2>
                        <a href="@yield('urlmenu')" class="text-white hover:text-[#FF6B35] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 space-y-6">
                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Nama Mahasiswa -->
                        <div class="space-y-2">
                            <label for="mhs_name" class="block text-sm font-medium text-[#2E2E2E]">Nama Mahasiswa</label>
                            <input type="text" name="mhs_name" id="mhs_name" 
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:border-[#FF6B35]"
                                value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}" readonly>
                            @error('mhs_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Departement -->
                        <div class="space-y-2">
                            <label for="dept_id" class="block text-sm font-medium text-[#2E2E2E]">Pilih Departement</label>
                            <select name="dept_id" id="dept_id" 
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:border-[#FF6B35]">
                                <option value="">Pilih Departement Tujuan</option>
                                <option value="1" {{ $dept == 1 ? 'selected' : '' }}>Departement Finance</option>
                                <option value="2" {{ $dept == 2 ? 'selected' : '' }}>Departement Officer</option>
                                <option value="3" {{ $dept == 3 ? 'selected' : '' }}>Departement Akademik</option>
                                <option value="4" {{ $dept == 4 ? 'selected' : '' }}>Departement Admin</option>
                                <option value="5" {{ $dept == 5 ? 'selected' : '' }}>Departement Support</option>
                            </select>
                            @error('dept_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prioritas -->
                        <div class="space-y-2">
                            <label for="prio_id" class="block text-sm font-medium text-[#2E2E2E]">Level Prioritas</label>
                            <select name="prio_id" id="prio_id" 
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:border-[#FF6B35]">
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

                    <!-- Subject -->
                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-medium text-[#2E2E2E]">Subject</label>
                        <input type="text" name="subject" id="subject" required
                            class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:border-[#FF6B35]"
                            placeholder="Inputkan subject ticket...">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-medium text-[#2E2E2E]">Message</label>
                        <textarea name="message" id="summernote" cols="30" rows="10"
                            class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#FF6B35] focus:border-[#FF6B35] min-h-[200px]"></textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#FF6B35] hover:bg-[#E05D2E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6B35] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Send Ticket
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>
        // Simple JavaScript for enhanced interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus styles programmatically
            const inputs = document.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-[#FF6B35]', 'ring-opacity-50');
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-[#FF6B35]', 'ring-opacity-50');
                });
            });
            
            // Priority level color coding
            const prioritySelect = document.getElementById('prio_id');
            if (prioritySelect) {
                prioritySelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    // Remove any existing color classes
                    this.classList.remove('border-red-300', 'border-yellow-300', 'border-green-300', 'border-orange-500');
                    
                    // Add appropriate color based on priority
                    switch(selectedOption.value) {
                        case '0': // Low
                            this.classList.add('border-green-300');
                            break;
                        case '1': // Medium
                            this.classList.add('border-yellow-300');
                            break;
                        case '2': // High
                            this.classList.add('border-orange-500');
                            break;
                        case '3': // Urgent
                            this.classList.add('border-red-300');
                            break;
                    }
                });
            }
        });
    </script>
@endsection
@section('custom-js')
@endsection
