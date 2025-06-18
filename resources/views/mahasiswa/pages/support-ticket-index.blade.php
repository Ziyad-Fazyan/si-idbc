@extends('base.base-dash-index')
@section('title')
    Ticket Support - Siakad By Internal Developer
@endsection
@section('menu')
    Ticket Support
@endsection
@section('submenu')
    Lihat Daftar Ticket Support
@endsection
@section('urlmenu')
    {{-- Jika ada URL untuk kembali ke halaman sebelumnya, bisa ditambahkan di sini --}}
@endsection
@section('subdesc')
    Halaman untuk melihat daftar ticket support
@endsection
@section('custom-css')
    {{-- Kelas subject-column ini bisa kita kelola dengan Tailwind jika diperlukan, atau tetap di sini jika ada kebutuhan spesifik --}}
    <style>
        .subject-column {
            width: 45% !important;
        }
    </style>
@endsection
@section('content')
    {{-- Mengubah background section dan menggunakan container yang konsisten --}}
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            {{-- Menyesuaikan background dan border header card --}}
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center">
                        {{-- Menambahkan ikon tiket untuk konsistensi --}}
                        <i class="fas fa-ticket-alt text-blue-600 mr-2"></i>
                        @yield('menu')
                    </h2>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        {{-- Menambahkan tombol "Buka Ticket Baru" di sini --}}
                        <a href="{{ route('mahasiswa.support.ticket-open') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Buka Ticket Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- Mengubah padding agar konsisten --}}
            <div class="p-6 overflow-x-auto">
                {{-- Menyesuaikan divide-y dan teks di thead --}}
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Prioritas</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Departement</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider subject-column">
                                Subject</th> {{-- Mempertahankan kelas custom-css --}}
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Last
                                Reply</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($ticket as $key => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 cursor-pointer">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ ++$key }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    {{-- Menyesuaikan warna prioritas --}}
                                    @if ($item->raw_prio_id === 0)
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            {{ $item->prio_id }}
                                        </span>
                                    @elseif ($item->raw_prio_id === 1)
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            {{ $item->prio_id }}
                                        </span>
                                    @elseif ($item->raw_prio_id === 2)
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                            {{ $item->prio_id }}
                                        </span>
                                    @elseif ($item->raw_prio_id === 3)
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            {{ $item->prio_id }}
                                        </span>
                                    @endif
                                </td>
                                {{-- Mengubah warna teks departemen --}}
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $item->dept_id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    {{-- Mengubah warna link --}}
                                    <a href="{{ route('mahasiswa.support.ticket-view', $item->code) }}"
                                        class="text-blue-600 hover:text-blue-800 transition-colors duration-150 font-semibold">
                                        #{{ $item->code }} - {{ $item->subject }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                    {{-- Menyesuaikan warna status --}}
                                    @if ($item->raw_stat_id === 0)
                                        {{-- Open --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 1)
                                        {{-- Closed --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 2)
                                        {{-- Pending --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 3)
                                        {{-- Solved --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 4)
                                        {{-- Replied --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 5)
                                        {{-- Assigned --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @elseif ($item->raw_stat_id === 6)
                                        {{-- Escalated --}}
                                        <span
                                            class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            {{ $item->stat_id }}
                                        </span>
                                    @endif
                                </td>
                                {{-- Mengubah warna teks Last Reply --}}
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    {{ $item->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            // Basic table interaction enhancements
            document.addEventListener('DOMContentLoaded', function() {
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    // Add click event to make entire row clickable (for the link in subject)
                    row.addEventListener('click', (e) => {
                        const link = row.querySelector('td:nth-child(4) a');
                        // Check if we didn't click on a link directly
                        if (e.target.tagName !== 'A' && link) {
                            window.location.href = link.href;
                        }
                    });

                    // Add hover effect
                    row.style.cursor =
                    'pointer'; // Ini sudah ditambahkan di HTML dengan `cursor-pointer` jadi bisa dihapus
                });
            });
        </script>
        <script>
            // Fungsi untuk memulai auto-refresh setiap 15 detik (sesuai permintaan sebelumnya)
            function startAutoRefresh() {
                setInterval(function() {
                    location.reload();
                }, 15000);
            }

            // Memulai auto-refresh secara default
            startAutoRefresh();
        </script>
    @endpush
@endsection
