<!-- Modal Edit Program Kuliah -->
@foreach ($proku as $item)
<div id="updateProku{{ $item->code }}"
    class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <form action="{{ route($prefix . 'master.proku-update', $item->code) }}" method="POST"
            enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                <h4 class="text-lg font-semibold text-gray-800">Edit Program Kuliah - {{ $item->name }}</h4>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                    <button type="button"
                        class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                        onclick="closeModal('updateProku{{ $item->code }}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-4 space-y-4">
                <div class="space-y-2">
                    <label for="taka_id" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                    <select name="taka_id" id="taka_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                        <option value="" selected>Pilih Tahun Akademik</option>
                        @foreach ($taka as $tk)
                            <option value="{{ $tk->id }}"
                                {{ $item->taka_id == $tk->id ? 'selected' : '' }}>
                                {{ $tk->name }}</option>
                        @endforeach
                    </select>
                    @error('taka_id')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="pstudi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select name="pstudi_id" id="pstudi_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                        <option value="" selected>Pilih Program Studi</option>
                        @foreach ($pstudi as $studi)
                            <option value="{{ $studi->id }}"
                                {{ $item->pstudi_id == $studi->id ? 'selected' : '' }}>
                                {{ $studi->name }}</option>
                        @endforeach
                    </select>
                    @error('pstudi_id')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Program
                        Kuliah</label>
                    <input type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                        name="name" id="name" placeholder="Inputkan nama Program Kuliah..."
                        value="{{ $item->name }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="code" class="block text-sm font-medium text-gray-700">Kode Program
                        Kuliah</label>
                    <input type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                        name="code" id="code" placeholder="Inputkan kode Program Kuliah..."
                        value="{{ $item->code }}" maxlength="20" uppercase>
                    @error('code')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="wave" class="block text-sm font-medium text-gray-700">Gelombang Program
                        Kuliah</label>
                    <input type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                        name="wave" id="wave" placeholder="Inputkan Gelombang Program Kuliah..."
                        value="{{ $item->wave }}" maxlength="20" uppercase>
                    @error('wave')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="wave_start" class="block text-sm font-medium text-gray-700">Periode Mulai
                        Pendaftaran</label>
                    <input type="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                        name="wave_start" id="wave_start" value="{{ $item->wave_start }}">
                    @error('wave_start')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
                <div class="space-y-2">
                    <label for="wave_ended" class="block text-sm font-medium text-gray-700">Periode Akhir
                        Pendaftaran</label>
                    <input type="date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                        name="wave_ended" id="wave_ended" value="{{ $item->wave_ended }}">
                    @error('wave_ended')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
