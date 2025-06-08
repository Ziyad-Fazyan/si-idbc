 <!-- Modal Edit Tahun Akademik -->
 @foreach ($taka as $item)
     <div id="updateTaka{{ $item->code }}"
         class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
         <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
             <form action="{{ route($prefix . 'master.taka-update', $item->code) }}" method="POST"
                 enctype="multipart/form-data">
                 @method('patch')
                 @csrf
                 <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                     <h4 class="text-lg font-semibold text-gray-800">Edit Tahun Akademik - {{ $item->name }}</h4>
                     <div class="flex space-x-2">
                         <button type="submit"
                             class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                             <i class="fas fa-paper-plane"></i>
                         </button>
                         <button type="button"
                             class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                             onclick="closeModal('updateTaka{{ $item->code }}')">
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
                             name="name" id="name" placeholder="Inputkan nama tahun akademik..."
                             value="{{ $item->name }}">
                         @error('name')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 6 Angka
                             )</label>
                         <input type="text"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                             name="code" id="code" placeholder="Inputkan kode tahun akademik..." maxlength="6"
                             uppercase onkeydown="return /[a-zA-Z0-9]/i.test(event.key)" value="{{ $item->code }}">
                         @error('code')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="semester" class="block text-sm font-medium text-gray-700">Semester
                             Perkuliahan</label>
                         <input type="number"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                             name="semester" id="semester" placeholder="Inputkan semester perkuliahan..."
                             value="{{ $item->raw_semester }}" min="1" max="20">
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
                             value="{{ $item->year_start }}" placeholder="Inputkan tahun masuk...">
                         @error('year_start')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                     <div class="space-y-2">
                         <label for="is_active" class="block text-sm font-medium text-gray-700">Status Tahun
                             Akademik</label>
                         <select name="is_active" id="is_active"
                             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                             <option value="0" {{ $item->is_active === 0 ? 'selected' : '' }}>Tidak Aktif</option>
                             <option value="1" {{ $item->is_active === 1 ? 'selected' : '' }}>Aktif</option>
                         </select>
                         @error('is_active')
                             <small class="text-red-500">{{ $message }}</small>
                         @enderror
                     </div>
                 </div>
             </form>
         </div>
     </div>
 @endforeach
