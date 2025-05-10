@extends('base.base-dash-index')
@section('title')
    Data Dokumen - Siakad By Internal Developer
@endsection
@section('menu')
    Data Dokumen
@endsection
@section('submenu')
    Daftar Dokumen
@endsection
@section('submenu0')
    Tambah Dokumen
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Dokumen
@endsection
@section('content')
    <section class="py-6">
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                    <div>
                        <a href="{{ route('web-admin.document-create') }}"
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-[#0C6E71] hover:bg-[#095658] text-white transition-colors duration-300">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="documents-table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        #</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Cover Image</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Nama Document</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Path File</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Author</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Created At</th>
                                    <th
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($docs as $key => $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            {{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <img src="{{ asset('storage/' . $item->cover) }}"
                                                class="mx-auto h-12 w-auto object-cover rounded" alt="{{ $item->name }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-xs">
                                            {{ $item->link == null ? $item->path : $item->link }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $item->author->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $item->created_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button type="button" onclick="openDocumentModal('{{ $item->code }}')"
                                                    class="inline-flex items-center px-2.5 py-1.5 border border-[#0C6E71] text-xs font-medium rounded text-[#0C6E71] bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                                    <i class="fas fa-eye mr-1"></i> View
                                                </button>

                                                <form id="delete-form-{{ $item->code }}"
                                                    action="{{ route($prefix . 'document-destroy', $item->code) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')"
                                                        class="inline-flex items-center px-2.5 py-1.5 border border-red-500 text-xs font-medium rounded text-red-500 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        <i class="fas fa-trash mr-1"></i> Delete
                                                    </button>
                                                </form>
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
    </section>

    <!-- Document View Modal -->
    <div id="documentModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Document Details</h3>
                <button onclick="closeDocumentModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]" id="modalContent">
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col md:flex-row md:space-x-4">
                        <div class="md:w-1/3 mb-4 md:mb-0">
                            <img id="documentCover" src="" class="w-full h-auto rounded-lg" alt="Document Cover">
                        </div>
                        <div class="md:w-2/3">
                            <div class="space-y-3">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">NAMA DOKUMEN</h4>
                                    <p id="documentName" class="text-base font-medium"></p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">PATH FILE</h4>
                                    <p id="documentPath" class="text-base"></p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">AUTHOR</h4>
                                    <p id="documentAuthor" class="text-base"></p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">CREATED AT</h4>
                                    <p id="documentCreated" class="text-base"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                <button onclick="closeDocumentModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Confirm Delete</h3>
            </div>
            <div class="p-6">
                <p class="text-gray-700">Are you sure you want to delete document: <span id="deleteDocumentName"
                        class="font-semibold"></span>?</p>
                <p class="text-gray-500 text-sm mt-2">This action cannot be undone.</p>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
                <button id="confirmDeleteButton"
                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Delete
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize data table if needed
            if (typeof DataTable !== 'undefined') {
                new DataTable('#documents-table', {
                    responsive: true
                });
            }
        });

        // Document Modal Functions
        function openDocumentModal(code) {
            // In a real implementation, you would fetch document details via AJAX
            // This is a mock implementation for demonstration
            const docs = @json($docs);
            const document = docs.find(doc => doc.code === code);

            if (document) {
                document.getElementById('modalTitle').textContent = document.name;
                document.getElementById('documentName').textContent = document.name;
                document.getElementById('documentPath').textContent = document.link || document.path;
                document.getElementById('documentAuthor').textContent = document.author.name;
                document.getElementById('documentCreated').textContent = document.created_at;
                document.getElementById('documentCover').src = `/storage/${document.cover}`;
                document.getElementById('documentCover').alt = document.name;

                document.getElementById('documentModal').classList.remove('hidden');
            }
        }

        function closeDocumentModal() {
            document.getElementById('documentModal').classList.add('hidden');
        }

        // Delete Modal Functions
        function confirmDelete(code, name) {
            document.getElementById('deleteDocumentName').textContent = name;
            document.getElementById('confirmDeleteButton').onclick = function() {
                document.getElementById(`delete-form-${code}`).submit();
            };
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            const documentModal = document.getElementById('documentModal');
            const deleteModal = document.getElementById('deleteModal');

            if (event.target === documentModal) {
                closeDocumentModal();
            }

            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });

        // Original delete function for compatibility
        function deleteData(code) {
            confirmDelete(code, document.querySelector(`#delete-form-${code}`).getAttribute('data-name'));
        }
    </script>
@endpush
