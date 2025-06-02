<script>
	$(document).ready(function () {
		$(".show-modal").click(function () {
			const id = $(this).data("id");
			let url = "{{ route('api.barang.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#show_commodity #item_code").val(res.data.item_code);
					$("#show_commodity #name").val(res.data.name);
					$("#show_commodity #commodity_location_id").val(
						res.data.commodity_location.name
					);
					$("#show_commodity #material").val(res.data.material);
					$("#show_commodity #brand").val(res.data.brand);
					$("#show_commodity #year_of_purchase").val(res.data.year_of_purchase);
					$("#show_commodity #condition").val(res.data.condition_name);
					$("#show_commodity #commodity_acquisition_id").val(
						res.data.commodity_acquisition.name
					);
					$("#show_commodity #note").val(res.data.note);
					$("#show_commodity #quantity").val(res.data.quantity);
					$("#show_commodity #price").val(res.data.price_formatted);
					$("#show_commodity #price_per_item").val(res.data.price_per_item_formatted);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$(".edit-modal").on("click", function () {
			const id = $(this).data("id");
			let url = "{{ route('api.barang.show', ':paramID') }}".replace(
				":paramID",
				id
			);

			let updateURL = "{{ route('barang.update', ':paramID') }}".replace(
				":paramID",
				id
			);

			$.ajax({
				url: url,
				method: "GET",
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#edit_commodity form #item_code").val(res.data.item_code);
					$("#edit_commodity form #name").val(res.data.name);
					$("#edit_commodity form #commodity_location_id").val(
						res.data.commodity_location.id
					);
					$("#edit_commodity form #material").val(res.data.material);
					$("#edit_commodity form #brand").val(res.data.brand);
					$("#edit_commodity form #year_of_purchase").val(
						res.data.year_of_purchase
					);
					$("#edit_commodity form #condition").val(res.data.condition);
					$("#edit_commodity form #commodity_acquisition_id").val(
						res.data.commodity_acquisition.id
					);
					$("#edit_commodity form #note").val(res.data.note);
					$("#edit_commodity form #quantity").val(res.data.quantity);
					$("#edit_commodity form #price").val(res.data.price);
					$("#edit_commodity form #price_per_item").val(
						res.data.price_per_item
					);
					$("#edit_commodity form").attr("action", updateURL);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});
	});
</script>
<x-filter>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="commodity_location_id">Lokasi Barang:</label>
                <select name="commodity_location_id" id="commodity_location_id" @class([ 'form-control' , 'is-valid'=>
                    request()->filled('commodity_location_id')
                    ])
                    >
                    <option value="">Pilih lokasi barang..</option>
                    @foreach ($commodity_locations as $commodity_location)
                    <option value="{{ $commodity_location->id }}"
                        @selected(request('commodity_location_id')==$commodity_location->id)>{{
                        $commodity_location->name
                        }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="commodity_acquisition_id">Asal Perolehan:</label>
                <select name="commodity_acquisition_id" id="commodity_acquisition_id" @class([ 'form-control'
                    , 'is-valid'=> request()->filled('commodity_acquisition_id')
                    ])
                    >
                    <option value="">Pilih asal perolehan..</option>
                    @foreach ($commodity_acquisitions as $commodity_acquisition)
                    <option value="{{ $commodity_acquisition->id }}"
                        @selected(request('commodity_acquisition_id')==$commodity_acquisition->id)>{{
                        $commodity_acquisition->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="condition">Kondisi:</label>
                <select name="condition" id="condition" @class([ 'form-control' , 'is-valid'=>
                    request()->filled('condition')
                    ])
                    >
                    <option value="">Pilih kondisi..</option>
                    <option value="1" @selected(request('condition')==1)>Baik</option>
                    <option value="2" @selected(request('condition')==2)>Kurang Baik</option>
                    <option value="3" @selected(request('condition')==3)>Rusak Berat</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="year_of_purchase">Tahun Pembelian:</label>
                <select name="year_of_purchase" id="year_of_purchase" @class([ 'form-control' , 'is-valid'=>
                    request()->filled('year_of_purchase')
                    ])
                    >
                    <option value="">Pilih tahun pembelian..</option>
                    @foreach ($year_of_purchases as $year_of_purchase)
                    <option value="{{ $year_of_purchase }}" @selected(request('year_of_purchase')==$year_of_purchase)>{{
                        $year_of_purchase }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="material">Bahan:</label>
                <select name="material" id="material" @class([ 'form-control' , 'is-valid'=> request()->filled('material')
                    ])
                    >
                    <option value="">Pilih bahan..</option>
                    @foreach ($commodity_materials as $material)
                    <option value="{{ $material }}" @selected(request('material')==$material)>{{
                        $material }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="brand">Merk:</label>
                <select name="brand" id="brand" @class([ 'form-control' , 'is-valid'=> request()->filled('brand')
                    ])
                    >
                    <option value="">Pilih merk..</option>
                    @foreach ($commodity_brands as $brand)
                    <option value="{{ $brand }}" @selected(request('brand')==$brand)>{{
                        $brand }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <x-slot name="resetFilterURL">{{ route('barang.index') }}</x-slot>
</x-filter>
