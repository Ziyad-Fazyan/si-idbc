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
@endsection
@section('subdesc')
    Halaman untuk melihat daftar ticket support
@endsection
@section('custom-css')
    <style>
        .subject-column {
            width: 45% !important;
        }
    </style>
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-[#0C6E71] px-4 py-3">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        @yield('menu')
                    </h2>
                    <div class="flex space-x-2">
                        <!-- Empty for now, but kept for potential future buttons -->
                    </div>
                </div>
            </div>

            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-[#E4E2DE]">
                    <thead class="bg-[#E4E2DE]">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Prioritas</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Departement</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Subject</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">Last
                                Reply</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#E4E2DE]">
                        @foreach ($ticket as $key => $item)
                            <tr class="hover:bg-[#F3EFEA] transition-colors duration-150">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm">
                                    @if ($item->raw_prio_id === 0)
                                        <span class="text-blue-500">{{ $item->prio_id }}</span>
                                    @elseif ($item->raw_prio_id === 1)
                                        <span class="text-yellow-500">{{ $item->prio_id }}</span>
                                    @elseif ($item->raw_prio_id === 2)
                                        <span class="text-red-500">{{ $item->prio_id }}</span>
                                    @elseif ($item->raw_prio_id === 3)
                                        <span class="text-red-600 font-bold">{{ $item->prio_id }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-[#2E2E2E]">{{ $item->dept_id }}</td>
                                <td class="px-4 py-3 text-sm text-[#2E2E2E]">
                                    <a href="{{ route('mahasiswa.support.ticket-view', $item->code) }}"
                                        class="text-[#0C6E71] hover:text-[#FF6B35] transition-colors duration-150">
                                        #{{ $item->code }} - {{ $item->subject }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                    @if ($item->raw_stat_id === 0)
                                        <span class="text-green-600 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 1)
                                        <span class="text-red-600 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 2)
                                        <span class="text-gray-400 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 3)
                                        <span class="text-green-600 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 4)
                                        <span class="text-blue-600 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 5)
                                        <span class="text-blue-400 font-bold">{{ $item->stat_id }}</span>
                                    @elseif ($item->raw_stat_id === 6)
                                        <span class="text-yellow-500 font-bold">{{ $item->stat_id }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-[#2E2E2E]">
                                    {{ $item->updated_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

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
                row.style.cursor = 'pointer';
            });
        });
    </script>
@endsection
@section('custom-js')
    <script>
        // Fungsi untuk memulai auto-refresh setiap 5 detik
        function startAutoRefresh() {
            setInterval(function() {
                // Lakukan refresh halaman
                location.reload();
            }, 15000); // Refresh setiap 5 detik
        }

        // Memulai auto-refresh secara default
        startAutoRefresh();
    </script>
@endsection
