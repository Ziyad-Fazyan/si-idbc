<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\CommodityAcquisition;
use App\Models\CommodityLocation;
use App\Models\Settings\webSettings;
use App\Helpers\roleTrait;
use App\Http\Requests\StoreCommodityRequest;
use App\Http\Requests\UpdateCommodityRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommodityController extends Controller
{
    use roleTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = webSettings::where('id', 1)->first();
        $prefix = $this->setPrefix();
        $commodities = Commodity::all();
        $commodityLocations = CommodityLocation::all();
        $commodityAcquisitions = CommodityAcquisition::all();
        return view('user.admin.master-inventory.commodities.index', compact('commodities', 'commodityLocations', 'commodityAcquisitions', 'web', 'prefix'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommodityRequest $request)
    {
        Commodity::create($request->validated());

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commodity = Commodity::with(['commodity_location', 'commodity_acquisition'])
            ->findOrFail($id);

        return response()->json($commodity);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommodityRequest $request, $code)
    {
        $commodity = Commodity::where('id', $code)->first();
        $commodity->update($request->all());

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commodity $commodity, $code)
    {
        $commodity = Commodity::where('id', $code)->first();
        $commodity->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
