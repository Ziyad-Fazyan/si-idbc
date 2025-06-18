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
@section('content')
    <!-- Main section container -->
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <!-- Card header -->
                <div class="bg-[#0C6E71] px-6 py-4 border-b border-[#E4E2DE]">
                    <h1 class="text-2xl font-semibold text-white">Daftar Ticket Support</h1>
                </div>

                <!-- Card body -->
                <div class="p-6 bg-white">
                    <!-- Table container -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-[#E4E2DE]">
                            <thead class="bg-[#F3EFEA]">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                        ID</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                        Judul</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#E4E2DE]">
                                <!-- Example data row -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">#12345</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">Masalah login</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        <button class="text-[#FF6B35] hover:text-[#e65a2b] font-medium">Detail</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination controls -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="text-sm text-[#3B3B3B]">
                            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari
                            <span class="font-medium">24</span> hasil
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 border border-[#E4E2DE] rounded text-sm text-[#3B3B3B] bg-white hover:bg-[#F3EFEA]">Sebelumnya</button>
                            <button
                                class="px-3 py-1 border border-[#E4E2DE] rounded text-sm text-white bg-[#0C6E71] hover:bg-[#0a5c5f]">1</button>
                            <button
                                class="px-3 py-1 border border-[#E4E2DE] rounded text-sm text-[#3B3B3B] bg-white hover:bg-[#F3EFEA]">Selanjutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Example interaction: toggle ticket detail
            document.querySelectorAll('[data-toggle="ticket-detail"]').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.getAttribute('data-ticket-id');
                    // Logic to show ticket detail
                    console.log(`Menampilkan detail ticket ${ticketId}`);
                });
            });

            // Add other interactions as needed
        });
    </script>
@endsection
