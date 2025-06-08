<form action="{{ route($prefix . 'master.kurikulum-store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
        <h4 class="text-lg font-semibold text-gray-800">Tambah Kurikulum</h4>
        <div class="flex space-x-2">
            <button type="submit"
                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-kurikulum'})"
                class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                x-on:click="$dispatch('close-modal', {name: 'createKurikulum'})">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="p-4 space-y-4">
        <div class="space-y-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Kurikulum</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                name="name" id="name" placeholder="Inputkan nama kurikulum...">
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="space-y-2">
            <label for="code" class="block text-sm font-medium text-gray-700">Kode Kurikulum ( 3
                Huruf Kapital )</label>
            <input type="text"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                name="code" id="code" placeholder="Inputkan kode kurikulum..." maxlength="3" uppercase
                onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
            @error('code')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label for="year_start" class="block text-sm font-medium text-gray-700">Pilih Tahun
                    Mulai Berlaku</label>
                <input type="number"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="year_start" id="year_start" min="2010" max="2100" maxlength="4"
                    value="{{ \Carbon\Carbon::now()->format('Y') }}" placeholder="Inputkan tahun mulai...">
                @error('year_start')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="year_ended" class="block text-sm font-medium text-gray-700">Pilih Tahun
                    Akhir Berlaku</label>
                <input type="number"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="year_ended" id="year_ended" min="2010" max="2100" maxlength="4"
                    value="{{ \Carbon\Carbon::now()->format('Y') }}" placeholder="Inputkan tahun akhir...">
                @error('year_ended')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="space-y-2">
            <label for="desc" class="block text-sm font-medium text-gray-700">Deskripsi
                Kurikulum</label>
            <textarea name="desc"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                id="desc" rows="5">Inputkan deskripsi kurikulum</textarea>
            @error('desc')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>
    </div>
</form>
