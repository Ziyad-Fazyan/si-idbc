<div>
    <div>
        <div>
            <h5>Tambah Data Ruangan</h5>
            <button type="button">
                <span>&times;</span>
                </button>
            </div>
        <div>
            <div>
                <i class="text-warning fa-solid fa-circle-info mr-2"></i>
                <p>
                    Kolom yang memiliki tanda merah <span>wajib diisi.</span>
                    </p>
                </div>

            <hr>
            <form action="{{ route($prefix . 'inventory.lokasi-store') }}" method="POST">
                @csrf
                <div>
                    <div>
                        <div>
                            <label for="name">Nama Ruangan<span>*</span></label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name') }}"
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
                            <label for="description">Deskripsi Ruangan
                                <span>(opsional)</span></label>

                            <textarea name="description" name="description" id="description"
                                placeholder="Masukan deskripsi (opsional).." name="description" style="height: 100px;">{{ old('description') }}</textarea>
                            @error('description', 'store')
                                <div>
                                    {{ $message }}
                                    </div>
                            @enderror

                        </div>
                        </div>
                    </div>
                <div>
                    <button type="button">Tutup</button>
                    <button type="submit">Tambah</button>
                    </div>
                </form>

        </div>
        </div>
    </div>
</div>
