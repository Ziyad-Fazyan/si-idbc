<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Helpers\roleTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommodityLocationExportRequest;
use App\Http\Requests\CommodityLocationImportRequest;
use App\Http\Requests\StoreCommodityLocationRequest;
use App\Http\Requests\UpdateCommodityLocationRequest;
use App\Models\CommodityLocation;
use App\Models\Settings\webSettings;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class CommodityLocationController extends Controller
{
    use roleTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $web = webSettings::where('id', 1)->first();
        $prefix = $this->setPrefix();
        $commodityLocations = CommodityLocation::orderBy('name', 'ASC')->get();
        $commodityLocations = CommodityLocation::latest()->paginate(7);
        return view('user.admin.master-inventory.commodity-locations.index', compact('commodityLocations', 'web', 'prefix'));
    }

    public function show($id)
    {
        $commodityLocation = CommodityLocation::findOrFail($id);
        return response()->json($commodityLocation);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommodityLocationRequest $request)
    {
        CommodityLocation::create($request->validated());

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommodityLocationRequest $request, $code)
    {
        $commodityLocation = CommodityLocation::where('id', $code)->first();

        if (!$commodityLocation) {
            return back()->with('error', 'Perolehan tidak ditemukan!');
        }

        $commodityLocation->update($request->all());

        Alert::success('success', 'Data telah berhasil disimpan');
        return back();
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($code)
    {
        try {
            $commodityLocation = CommodityLocation::findOrFail($code);

            if ($commodityLocation->commodities()->exists()) {
                Alert::error('Error', 'Ruangan tidak dapat dihapus karena masih terkait dengan data barang!');
                return back();
            }

            $commodityLocation->delete();

            Alert::success('Success', 'Data ruangan berhasil dihapus');
            return back();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Alert::error('Error', 'Data ruangan tidak ditemukan!');
            return back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            return back();
        }
    }

    /**
     * Export commodities data to Excel.
     */
    // public function export(CommodityLocationExportRequest $request)
    // {
    //     $this->authorize('export ruangan');

    //     $filename = 'daftar-ruangan-' . date('d-m-Y');

    //     return match ($request->extension) {
    //         'xlsx' => Excel::download(new CommodityLocationsExport, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX),
    //         'xls' => Excel::download(new CommodityLocationsExport, $filename . '.xls', \Maatwebsite\Excel\Excel::XLS),
    //         'csv' => Excel::download(new CommodityLocationsExport, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV),
    //         'html' => Excel::download(new CommodityLocationsExport, $filename . '.html', \Maatwebsite\Excel\Excel::HTML),
    //     };
    // }

    /**
     * Import commodity locations data from Excel.
     */
    // public function import(CommodityLocationImportRequest $request)
    // {
    //     Excel::import(new CommodityLocationsImport, $request->file('file'));

    //     return to_route('ruangan.index')->with('success', 'Data ruangan berhasil diimpor!');
    // }
}
