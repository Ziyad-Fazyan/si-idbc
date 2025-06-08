    <form action="{{ route($prefix . 'master.taka-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="border-b border-gray-200 p-4 flex justify-between items-center">
            <h4 class="text-lg font-semibold text-gray-800">Tambah Tahun Akademik</h4>
            <div class="flex space-x-2">
                <button type="submit"
                    class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                    x-on:click="$dispatch('close-modal', {name: 'createTaka'})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4 space-y-4">
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Tahun
                    Akademik</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="name" id="name" placeholder="Inputkan nama tahun akademik...">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 6
                    Angka )</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="code" id="code" placeholder="Inputkan kode tahun akademik..."
                    maxlength="6" uppercase onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                @error('code')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester
                    Perkuliahan</label>
                <input type="number"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="semester" id="semester" placeholder="Inputkan kode tahun akademik...">
                @error('semester')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="year_start" class="block text-sm font-medium text-gray-700">Pilih Tahun
                    Masuk</label>
                <input type="number"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="year_start" id="year_start" min="2000" max="2100" maxlength="4"
                    value="{{ \Carbon\Carbon::now()->format('Y') }}" placeholder="Inputkan tahun masuk...">
                @error('year_start')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </form>
