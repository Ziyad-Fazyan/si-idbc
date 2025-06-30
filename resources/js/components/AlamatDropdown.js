// resources/js/components/AlamatDropdown.js

export default function alamatDropdown({
    provinsiId = 'provinsi',
    kabupatenId = 'kabupaten',
    kecamatanId = 'kecamatan',
    kelurahanId = 'kelurahan',
    provinsiNameId = 'provinsi_name',
    kabupatenNameId = 'kabupaten_name',
    kecamatanNameId = 'kecamatan_name',
    kelurahanNameId = 'kelurahan_name',
    old = {},
    apiBaseUrl = 'https://www.emsifa.com/api-wilayah-indonesia/api'
} = {}) {
    const provinsiSelect = document.getElementById(provinsiId);
    const kabupatenSelect = document.getElementById(kabupatenId);
    const kecamatanSelect = document.getElementById(kecamatanId);
    const kelurahanSelect = document.getElementById(kelurahanId);

    // Helper to update hidden input
    const updateHiddenInput = (selectElement, hiddenInputId) => {
        if (!hiddenInputId) return;
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const el = document.getElementById(hiddenInputId);
        if (el) el.value = selectedOption?.dataset?.name || '';
    };

    // Helper to load wilayah
    const loadWilayah = async (url, selectElement, placeholder, hiddenInputId = null, oldValue = null) => {
        try {
            selectElement.disabled = true;
            selectElement.innerHTML = `<option value="">Memuat ${placeholder}...</option>`;
            const response = await fetch(url);
            if (!response.ok) throw new Error('Gagal memuat data');
            const data = await response.json();
            selectElement.innerHTML = `<option value="">Pilih ${placeholder}</option>`;
            data.forEach(item => {
                const option = new Option(item.name, item.id);
                option.dataset.name = item.name;
                selectElement.add(option);
            });
            if (oldValue) {
                selectElement.value = oldValue;
                updateHiddenInput(selectElement, hiddenInputId);
            }
            selectElement.disabled = false;
            return true;
        } catch (error) {
            selectElement.innerHTML = `<option value="">Gagal memuat ${placeholder}</option>`;
            selectElement.disabled = false;
            return false;
        }
    };

    // Set old values if provided
    if (provinsiSelect) provinsiSelect.dataset.old = old.provinsi || '';
    if (kabupatenSelect) kabupatenSelect.dataset.old = old.kabupaten || '';
    if (kecamatanSelect) kecamatanSelect.dataset.old = old.kecamatan || '';
    if (kelurahanSelect) kelurahanSelect.dataset.old = old.kelurahan || '';

    // Initial load
    loadWilayah(`${apiBaseUrl}/provinces.json`, provinsiSelect, 'Provinsi', provinsiNameId, provinsiSelect?.dataset.old)
        .then(success => {
            if (success && provinsiSelect?.dataset.old) {
                loadWilayah(`${apiBaseUrl}/regencies/${provinsiSelect.dataset.old}.json`, kabupatenSelect, 'Kabupaten/Kota', kabupatenNameId, kabupatenSelect?.dataset.old)
                    .then(success => {
                        if (success && kabupatenSelect?.dataset.old) {
                            loadWilayah(`${apiBaseUrl}/districts/${kabupatenSelect.dataset.old}.json`, kecamatanSelect, 'Kecamatan', kecamatanNameId, kecamatanSelect?.dataset.old)
                                .then(success => {
                                    if (success && kecamatanSelect?.dataset.old) {
                                        loadWilayah(`${apiBaseUrl}/villages/${kecamatanSelect.dataset.old}.json`, kelurahanSelect, 'Kelurahan/Desa', kelurahanNameId, kelurahanSelect?.dataset.old);
                                    }
                                });
                        }
                    });
            }
        });

    // Provinsi change
    provinsiSelect?.addEventListener('change', function() {
        const provinsiId = this.value;
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        if (kabupatenNameId) document.getElementById(kabupatenNameId).value = '';
        if (kecamatanNameId) document.getElementById(kecamatanNameId).value = '';
        if (kelurahanNameId) document.getElementById(kelurahanNameId).value = '';
        updateHiddenInput(provinsiSelect, provinsiNameId);
        if (provinsiId) {
            loadWilayah(`${apiBaseUrl}/regencies/${provinsiId}.json`, kabupatenSelect, 'Kabupaten/Kota', kabupatenNameId);
        } else {
            kabupatenSelect.disabled = true;
            kecamatanSelect.disabled = true;
            kelurahanSelect.disabled = true;
        }
    });
    // Kabupaten change
    kabupatenSelect?.addEventListener('change', function() {
        const kabupatenId = this.value;
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        if (kecamatanNameId) document.getElementById(kecamatanNameId).value = '';
        if (kelurahanNameId) document.getElementById(kelurahanNameId).value = '';
        updateHiddenInput(kabupatenSelect, kabupatenNameId);
        if (kabupatenId) {
            loadWilayah(`${apiBaseUrl}/districts/${kabupatenId}.json`, kecamatanSelect, 'Kecamatan', kecamatanNameId);
        } else {
            kecamatanSelect.disabled = true;
            kelurahanSelect.disabled = true;
        }
    });
    // Kecamatan change
    kecamatanSelect?.addEventListener('change', function() {
        const kecamatanId = this.value;
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
        if (kelurahanNameId) document.getElementById(kelurahanNameId).value = '';
        updateHiddenInput(kecamatanSelect, kecamatanNameId);
        if (kecamatanId) {
            loadWilayah(`${apiBaseUrl}/villages/${kecamatanId}.json`, kelurahanSelect, 'Kelurahan/Desa', kelurahanNameId);
        } else {
            kelurahanSelect.disabled = true;
        }
    });
    // Kelurahan change
    kelurahanSelect?.addEventListener('change', function() {
        updateHiddenInput(kelurahanSelect, kelurahanNameId);
    });
}
