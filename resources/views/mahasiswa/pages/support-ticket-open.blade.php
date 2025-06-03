@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Pilih Departement
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk memilih Departement
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                            <i class="fas fa-ticket-alt text-blue-600 mr-2"></i>
                            @yield('menu')
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">@yield('subdesc')</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Finance Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 1) }}" class="group">
                        <div class="border border-yellow-200 rounded-lg p-5 hover:border-yellow-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-yellow-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4 group-hover:bg-yellow-200 transition-colors">
                                    <i class="fas fa-money-bill-wave text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Finance</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan dengan tagihan dan keuangan</p>
                        </div>
                    </a>

                    <!-- Attendance Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 2) }}" class="group">
                        <div class="border border-green-200 rounded-lg p-5 hover:border-green-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-green-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4 group-hover:bg-green-200 transition-colors">
                                    <i class="fas fa-user-clock text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Absen</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan dengan pendaftaran dan informasi PMB</p>
                        </div>
                    </a>

                    <!-- Academic Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 3) }}" class="group">
                        <div class="border border-blue-200 rounded-lg p-5 hover:border-blue-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-blue-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4 group-hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-graduation-cap text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Akademik</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan dengan perkuliahan dan administrasi akademik</p>
                        </div>
                    </a>

                    <!-- Musyrif Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 4) }}" class="group">
                        <div class="border border-red-200 rounded-lg p-5 hover:border-red-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-red-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-red-100 text-red-600 mr-4 group-hover:bg-red-200 transition-colors">
                                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Musyrif</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan terdapat kendala saat perkuliahan berlangsung</p>
                        </div>
                    </a>

                    <!-- Support Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 5) }}" class="group md:col-span-2">
                        <div class="border border-cyan-200 rounded-lg p-5 hover:border-cyan-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-cyan-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-cyan-100 text-cyan-600 mr-4 group-hover:bg-cyan-200 transition-colors">
                                    <i class="fas fa-headset text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Support</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan terdapat kendala teknis pada device kalian</p>
                        </div>
                    </a>

                    <!-- Site Manager Department -->
                    <a href="{{ route('mahasiswa.support.ticket-create', 6) }}" class="group md:col-span-2">
                        <div class="border border-indigo-200 rounded-lg p-5 hover:border-indigo-400 transition-all duration-300 hover:shadow-md bg-gradient-to-br from-indigo-50 to-white">
                            <div class="flex items-center mb-3">
                                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4 group-hover:bg-indigo-200 transition-colors">
                                    <i class="fas fa-laptop-code text-xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Departement Site Manager</h3>
                            </div>
                            <p class="text-sm text-gray-600 pl-16">Pilih ini apabila berhubungan terdapat kendala teknis pada device kalian</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection