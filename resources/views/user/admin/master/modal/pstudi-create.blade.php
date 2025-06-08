<x-modal name="createPstudi" :show="false" maxWidth="lg" persistent="false">
    <form action="{{ route($prefix . 'master.pstudi-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="border-b border-gray-200 p-4 flex justify-between items-center">
            <h4 class="text-lg font-semibold text-gray-800">Tambah Program Studi</h4>
            <div class="flex space-x-2">
                <button type="submit"
                    class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
                <button type="button"
                    class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                    x-on:click="$dispatch('close-modal', {name: 'createPstudi'})">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="p-4 space-y-4">
            <div class="space-y-2">
                <label for="faku_id" class="block text-sm font-medium text-gray-700">Fakultas</label>
                <select name="faku_id" id="faku_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                    <option value="" selected>Pilih Fakultas</option>
                    @foreach ($fakultas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('faku_id')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Program
                    Studi</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="name" id="name" placeholder="Inputkan nama program studi...">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="code" class="block text-sm font-medium text-gray-700">Kode Program Studi ( 2
                    Angka )</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="code" id="code" placeholder="Inputkan kode program studi..."
                    maxlength="2" uppercase onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                @error('code')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="cnim" class="block text-sm font-medium text-gray-700">Kode Awal NIM ( 5
                    Angka )</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="cnim" id="cnim" placeholder="Inputkan kode awal NIM program studi..."
                    maxlength="5" uppercase onkeydown="return /[0-9]/i.test(event.key)">
                @error('cnim')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="title" class="block text-sm font-medium text-gray-700">Gelar Program
                    Studi</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="title" id="title" placeholder="Inputkan gelar program studi..." uppercase>
                @error('title')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="level" class="block text-sm font-medium text-gray-700">Jenjang Program
                    Studi</label>
                <input type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                    name="level" id="level" placeholder="Inputkan jenjang program studi..." uppercase>
                @error('level')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </form>
</x-modal>