@extends('base.base-dash-index')

@section('title', 'Data Kesehatan Mahasiswa')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <ol class="flex items-center space-x-2 text-sm">
                            <li><a href="{{ route($prefix . 'home-index') }}"
                                    class="text-blue-600 hover:text-blue-800">Dashboard</a></li>
                            <li class="text-gray-500">/</li>
                            <li class="text-gray-700">Data Kesehatan Mahasiswa</li>
                        </ol>
                        <h4 class="text-2xl font-semibold text-gray-900 mt-1">Data Kesehatan Mahasiswa</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
                            <div>
                                <button onclick="exportPDF()"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md flex items-center gap-2">
                                    <i class="mdi mdi-file-pdf"></i> Export PDF
                                </button>
                            </div>
                            <div class="w-full md:w-auto">
                                <div class="flex">
                                    <input type="text" id="searchInput" placeholder="Cari mahasiswa..."
                                        class="border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                                    <button
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r-md">Cari</button>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="mahasiswa-health-datatable">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            No</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            IQ</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Logika</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Golongan Darah</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tinggi Badan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Berat Badan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($students as $index => $detail)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $index + 1 }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->mhs_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $detail->mhs_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->mahasiswaDetails->mhs_iq ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->mahasiswaDetails->mhs_logic ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $detail->mahasiswaDetails->mhs_goldar ?? '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ optional($detail->mahasiswaDetails)->mhs_tinggi_badan ? $detail->mahasiswaDetails->mhs_tinggi_badan . ' cm' : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ optional($detail->mahasiswaDetails)->mhs_berat_badan ? $detail->mahasiswaDetails->mhs_berat_badan . ' kg' : '-' }}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route($prefix . 'mahasiswa-health.edit', $detail->mhs_code) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#mahasiswa-health-datatable').DataTable({
                responsive: true,
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'>",
                        "next": "<i class='mdi mdi-chevron-right'>"
                    },
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ data keseluruhan)"
                },
                "drawCallback": function() {
                    $('.dataTables_paginate > .pagination').addClass('flex space-x-2');
                    $('.dataTables_paginate > .pagination > .paginate_button').addClass(
                        'px-3 py-1 rounded-md');
                    $('.dataTables_paginate > .pagination > .paginate_button.current').addClass(
                        'bg-blue-600 text-white');
                    $('.dataTables_paginate > .pagination > .paginate_button:not(.current)').addClass(
                        'bg-gray-200 hover:bg-gray-300');
                }
            });

            // Pencarian
            $('#searchInput').keyup(function() {
                $('#mahasiswa-health-datatable').DataTable().search($(this).val()).draw();
            });
        });

        function exportPDF() {
            // Implementasi export PDF
            alert('Fitur export PDF akan segera tersedia');
        }
    </script>
@endsection
