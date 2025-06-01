<div>
    <div>
        <div>
            <h5>Detail Data Perolehan</h5>
            <button type="button" x-data @click="$dispatch('close-modal', {name: 'show-perolehan'})">
                <span class="text-blue-500">Keluar</span>
            </button>
        </div>
        <div>
            <div>
                <div>
                    <label for="name">Nama Perolehan</label>
                    {{ $commodityAcquisition->name }}
                </div>
            </div>
            <div>
                <div>
                    <label for="description">Deskripsi Perolehan</label>
                    <textarea name="description" id="description" style="height: 100px;" disabled></textarea>
                </div>
            </div>
        </div>
        <div>
            {{ $commodityAcquisition->description }}
        </div>
    </div>
</div>
</div>
</div>
