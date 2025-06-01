<div>
    <div>
        <div>
            <h5>Tambah Data Perolehan</h5>
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-perolehan'})">
            <i class="fas fa-fw fa-times"></i>
            <span>Keluar</span>
            </button>
        </div>
        <div>
            <div>
                <i class="text-warning fa-solid fa-circle-info mr-2"></i>
                <p>
                    Kolom yang memiliki tanda merah <span class="text-red-500">wajib diisi.</span>
                </p>
            </div>

            <hr>
            <form action="{{ route($prefix . 'inventory.perolehan-store') }}" method="POST">
                @csrf
                <div>
                    <div>
                        <div>
                            <label for="name">Nama Perolehan<span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Masukan nama..">
                            @error('name', 'store')
                                <div>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="description">Deskripsi Perolehan
                                <span class="text-grey-500">(opsional)</span></label>

                            <textarea name="description" name="description" id="description" style="height: 100px;"
                                placeholder="Masukan deskripsi (opsional)..">{{ old('description') }}</textarea>
                            @error('description', 'store')
                                <div>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" x-data @click="$dispatch('close-modal', {name: 'create-perolehan'})">Tutup</button>
                    <button type="submit">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
