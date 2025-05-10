@extends('base.base-dash-index')

@section('title')
    Data Approval Absensi - Siakad By Internal Developer
@endsection

@section('menu')
    Data Approval Absensi
@endsection

@section('submenu')
    Lihat Data
@endsection

@section('urlmenu')
    #
@endsection

@section('subdesc')
    Halaman untuk melihat Data Approval Absensi
@endsection

@section('content')
    <section class="flex flex-wrap">
        <div class="w-full">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/3 md:w-1/2 p-2">
                    <a href="{{ route($prefix . 'approval.absen-index') }}">
                        <div class="bg-white border border-[#0C6E71] rounded-lg hover:bg-[#0C6E71]/10 transition-colors duration-300 h-full">
                            <div class="flex items-center justify-between p-4">
                                <span class="text-[#0C6E71] mr-4">
                                    <i class="fa-solid fa-person-circle-question text-4xl"></i>
                                </span>
                                <span class="text-gray-800 text-base">
                                    {{ App\Models\uAttendance::where('absen_approve', 1)->count() }}<br>
                                    Approval Absen
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-full lg:w-1/3 md:w-1/2 p-2">
                    <a href="{{ route($prefix . 'approval.absen-index-approved') }}">
                        <div class="bg-white border border-[#0C6E71] rounded-lg hover:bg-[#0C6E71]/10 transition-colors duration-300 h-full">
                            <div class="flex items-center justify-between p-4">
                                <span class="text-[#0C6E71] mr-4">
                                    <i class="fa-solid fa-person-circle-check text-4xl"></i>
                                </span>
                                <span class="text-gray-800 text-base">
                                    {{ App\Models\uAttendance::where('absen_approve', 2)->count() }}<br>
                                    Approved Absen
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-full lg:w-1/3 md:w-1/2 p-2">
                    <a href="{{ route($prefix . 'approval.absen-index-rejected') }}">
                        <div class="bg-white border border-[#0C6E71] rounded-lg hover:bg-[#0C6E71]/10 transition-colors duration-300 h-full">
                            <div class="flex items-center justify-between p-4">
                                <span class="text-[#0C6E71] mr-4">
                                    <i class="fa-solid fa-person-circle-xmark text-4xl"></i>
                                </span>
                                <span class="text-gray-800 text-base">
                                    {{ App\Models\uAttendance::where('absen_approve', 3)->count() }}<br>
                                    Rejected Absen
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full mt-4">
            <div class="bg-white rounded-lg shadow-md">
                <div class="border-b border-gray-200 p-4">
                    <h5 class="font-medium text-lg text-gray-700">@yield('menu')</h5>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto" id="table1">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-center w-12">#</th>
                                    <th class="px-4 py-2 text-center">Nama Lengkap</th>
                                    <th class="px-4 py-2 text-center">Type Izin</th>
                                    <th class="px-4 py-2 text-center">Tanggal</th>
                                    <th class="px-4 py-2 text-center">Status</th>
                                    <th class="px-4 py-2 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($absen as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-center">{{ ++$key }}</td>
                                        <td class="px-4 py-2">{{ $item->user->name }}</td>
                                        <td class="px-4 py-2">{{ $item->absen_type }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->absen_date)->format('d M Y') }}</td>
                                        <td class="px-4 py-2">{{ $item->absen_approve }}</td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center justify-center space-x-2">
                                                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md bg-[#0C6E71] text-white hover:bg-[#0C6E71]/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]"
                                                    data-modal-toggle="checkApprove{{ $item->absen_code }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>

                                                @if ($item->raw_absen_approve == 1)
                                                    <form id="accept-form-{{ $item->absen_code }}" action="{{ route($prefix . 'approval.absen-update-accept', $item->absen_code) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                            onclick="acceptData('{{ $item->absen_code }}')">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    </form>

                                                    <form id="reject-form-{{ $item->absen_code }}" action="{{ route($prefix . 'approval.absen-update-reject', $item->absen_code) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                            onclick="rejectData('{{ $item->absen_code }}')">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </form>
                                                @elseif($item->raw_absen_approve == 2)
                                                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md bg-green-500 text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                                        data-modal-toggle="checkApprove{{ $item->absen_code }}">
                                                        <i class="fa-solid fa-check"></i>
                                                    </button>
                                                @elseif($item->raw_absen_approve == 3)
                                                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                                        data-modal-toggle="checkApprove{{ $item->absen_code }}">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        @foreach ($absen as $item)
            <div id="checkApprove{{ $item->absen_code }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50" style="display: none;">
                <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4">
                    <div class="modal-header flex justify-between items-center border-b border-gray-200 p-4">
                        <h4 class="modal-title text-lg font-medium text-gray-700">Lihat Alasan - {{ $item->user->name }}</h4>
                        <button type="button" class="p-2 rounded border border-red-500 text-red-500 hover:bg-red-50" onclick="closeModal('{{ $item->absen_code }}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <span class="font-bold text-gray-700">Keterangan</span>
                            <div class="mt-2 prose max-w-none">
                                {!! $item->absen_desc !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    @push('scripts')
        <script>
            function closeModal(id) {
                document.getElementById("checkApprove" + id).style.display = 'none';
            }

            document.querySelectorAll('[data-modal-toggle]').forEach(button => {
                button.addEventListener('click', function () {
                    const modalId = this.getAttribute('data-modal-toggle');
                    document.getElementById(modalId).style.display = 'flex';
                });
            });
        </script>
    @endpush
@endsection
