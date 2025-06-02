<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Helpers\roleTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommodityAcquisitionRequest;
use App\Http\Requests\UpdateCommodityAcquisitionRequest;
use App\Models\CommodityAcquisition;
use App\Models\Settings\webSettings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommodityAcquisitionController extends Controller
{
    use roleTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = webSettings::where('id', 1)->first();
        $prefix = $this->setPrefix();
        $commodityAcquisitions = CommodityAcquisition::orderBy('name', 'ASC')->get();

        return view('user.admin.master-inventory.commodity-acquisitions.index', compact('commodityAcquisitions', 'web', 'prefix'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $commodityAcquisition = CommodityAcquisition::findOrFail($id);
        return response()->json($commodityAcquisition);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommodityAcquisitionRequest $request)
    {
        CommodityAcquisition::create($request->validated());

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommodityAcquisitionRequest $request, $code)
    {
        $commodityAcquisition = CommodityAcquisition::where('id', $code)->first();

        if (!$commodityAcquisition) {
            return back()->with('error', 'Perolehan tidak ditemukan!');
        }

        $commodityAcquisition->update($request->validated());

        Alert::success('success', 'Data telah berhasil diupdate');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommodityAcquisition $commodityAcquisition, $code)
    {
        if ($commodityAcquisition->commodities->isNotEmpty()) {
            return to_route('perolehan.index')
                ->with('error', 'Perolehan tidak dapat dihapus karena masih terkait dengan data komoditas!');
        }

        $commodityAcquisition = CommodityAcquisition::where('id', $code)->first();
        $commodityAcquisition->delete();

        Alert::success('success', 'Data telah berhasil dihapus');
        return back();
    }
}
