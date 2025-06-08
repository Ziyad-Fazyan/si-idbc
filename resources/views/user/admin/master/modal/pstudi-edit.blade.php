 <!-- Modal Edit Program Studi -->
 @foreach ($pstudi as $item)
     <div id="updatePStudi{{ $item->code }}"
         class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
         <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
             <form action="{{ route($prefix . 'master.pstudi-update', $item->code) }}" method="POST"
                 enctype="multipart/form-data">
                 @method('patch')
                 @csrf
                 <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                     <h4 class="text-lg font-semibold text-gray-800">Edit Program Studi - {{ $item->name }}</h4>
                     <div class="flex space-x-2">
                         <button type="submit"
                             class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                             <i class="fas fa-paper-plane"></i>
                         </button>
                         <button type="button"
                             class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                             onclick="closeModal('updatePStudi{{ $item->code }}')">
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
                             @foreach ($fakultas as $faku)
                                 <option value="{{ $faku->id }}"
                                     {{ $item->faku_id == $faku->id ? 'selected' : '' }}>
                                     {{ $faku->name }}</option>
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
                             name="name" id="name" placeholder="Inputkan nama program studi..."
                             value="{{ $item->name }}">
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
                             value="{{ $item->code }}" maxlength="2" uppercase
                             onkeydown="return /[a-zA-Z0-9]/i.test(event.key)">
                         @error('code')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="cnim" class="block text-sm font-medium text-gray-700">Kode Awal NIM ( 5 Angka
                             )</label>
                         <input type="text"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                             name="cnim" id="cnim" placeholder="Inputkan kode awal NIM program studi..."
                             value="{{ $item->cnim }}" maxlength="5" uppercase
                             onkeydown="return /[0-9]/i.test(event.key)">
                         @error('cnim')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="title" class="block text-sm font-medium text-gray-700">Gelar Program
                             Studi</label>
                         <input type="text"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                             name="title" id="title" placeholder="Inputkan gelar program studi..."
                             value="{{ $item->title }}" uppercase>
                         @error('title')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="level" class="block text-sm font-medium text-gray-700">Jenjang Program
                             Studi</label>
                         <input type="text"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                             name="level" id="level" placeholder="Inputkan jenjang program studi..."
                             value="{{ $item->level }}" uppercase>
                         @error('level')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="head_id" class="block text-sm font-medium text-gray-700">Kepala Program
                             Studi</label>
                         <select name="head_id" id="head_id"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                             <option value="" selected>Pilih Kepala Program Studi</option>
                             @foreach ($dosen as $dsn)
                                 <option value="{{ $dsn->id }}"
                                     {{ $item->head_id == $dsn->id ? 'selected' : '' }}>
                                     {{ $dsn->dsn_name }}</option>
                             @endforeach
                         </select>
                         @error('head_id')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                 </div>
             </form>
         </div>
     </div>
 @endforeach
