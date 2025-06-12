<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Helpers\RoleTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommodityAcquisitionRequest;
use App\Http\Requests\UpdateCommodityAcquisitionRequest;
use App\Models\CommodityAcquisition;
use App\Models\Settings\WebSettings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommodityAcquisitionController extends Controller
{
    use RoleTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = WebSettings::where('id', 1)->first();
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
    public function destroy($code)
    {
        try {
            $commodityAcquisition = CommodityAcquisition::findOrFail($code);

            if ($commodityAcquisition->commodities()->exists()) {
                Alert::error('Error', 'Perolehan tidak dapat dihapus karena masih terkait dengan data barang!');
                return back();
            }

            $commodityAcquisition->delete();

            Alert::success('Success', 'Data perolehan berhasil dihapus');
            return back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Data perolehan tidak ditemukan!');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return back();
        }
    }
}
