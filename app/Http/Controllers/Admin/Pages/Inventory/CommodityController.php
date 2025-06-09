<?php

namespace App\Http\Controllers\Admin\Pages\Inventory;

use App\Exports\CommoditiesExport;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\CommodityAcquisition;
use App\Models\Settings\webSettings;
use App\Helpers\roleTrait;
use App\Http\Requests\CommodityExportRequest;
use App\Http\Requests\StoreCommodityRequest;
use App\Http\Requests\UpdateCommodityRequest;
use App\Models\Ruang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class CommodityController extends Controller
{
    use roleTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $web = webSettings::where('id', 1)->first();
        $prefix = $this->setPrefix();

        // Base query with relationships
        $query = Commodity::with(['ruang', 'commodity_acquisition']);

        // Apply filters based on request parameters
        $this->applyFilters($query, $request);

        // Get filtered commodities
        $commodities = $query->get();

        // Get all data for filter dropdowns
        $ruangs = Ruang::all();
        $commodityAcquisitions = CommodityAcquisition::all();

        // Calculate statistics
        $totalItems = $commodities->count();
        $goodCondition = $commodities->where('condition', 1)->count();
        $minorDamage = $commodities->where('condition', 2)->count();
        $heavyDamage = $commodities->where('condition', 3)->count();

        // pagination
        $commodities = $query->paginate(10)->withQueryString();

        // Get unique values for filter options
        $filterOptions = $this->getFilterOptions();

        return view('user.admin.master-inventory.commodities.index', compact(
            'commodities',
            'ruangs',
            'commodityAcquisitions',
            'web',
            'prefix',
            'filterOptions',
            'totalItems',
            'goodCondition',
            'minorDamage',
            'heavyDamage'
        ));
    }

    /**
     * Apply filters to the commodity query
     */
    protected function applyFilters($query, $request)
    {
        // Apply search filter
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('item_code', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Apply location filter
        if ($request->has('ruang_id') && $request->ruang_id) {
            $query->where('ruang_id', $request->ruang_id);
        }

        // Apply acquisition filter
        if ($request->has('commodity_acquisition_id') && $request->commodity_acquisition_id) {
            $query->where('commodity_acquisition_id', $request->commodity_acquisition_id);
        }

        // Apply condition filter
        if ($request->has('condition') && $request->condition) {
            $query->where('condition', $request->condition);
        }

        // Apply year range filter
        if ($request->has('year_from') && $request->year_from) {
            $query->where('year_of_purchase', '>=', $request->year_from);
        }

        if ($request->has('year_to') && $request->year_to) {
            $query->where('year_of_purchase', '<=', $request->year_to);
        }

        // Apply sorting
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        return $query;
    }

    /**
     * Get filter options for dropdowns
     */
    private function getFilterOptions()
    {
        $years = Commodity::distinct('year_of_purchase')
            ->orderBy('year_of_purchase', 'desc')
            ->pluck('year_of_purchase')
            ->filter()
            ->toArray();

        $conditions = [
            'good' => 'Baik',
            'slightly_damaged' => 'Rusak Ringan',
            'heavily_damaged' => 'Rusak Berat',
            'lost' => 'Hilang'
        ];

        return [
            'years' => $years,
            'conditions' => $conditions
        ];
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
        $commodity = Commodity::with(['ruang', 'commodity_acquisition'])
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

    /**
     * Generate PDF for all commodities.
     */
    public function generatePDF()
    {
        $this->authorize('print barang');

        $commodities = Commodity::all();
        $sekolah = env('NAMA_SEKOLAH', 'Barang Milik Sekolah');
        $pdf = Pdf::loadView('commodities.pdf', compact(['commodities', 'sekolah']))->setPaper('a4');

        return $pdf->download('print.pdf');
    }

    /**
     * Generate PDF for a specific commodity.
     */
    public function generatePDFIndividually($id)
    {
        $this->authorize('print individual barang');

        $commodity = Commodity::find($id);
        $sekolah = env('NAMA_SEKOLAH', 'Barang Milik Sekolah');
        $pdf = Pdf::loadView('commodities.pdfone', compact(['commodity', 'sekolah']))->setPaper('a4');

        return $pdf->download('print.pdf');
    }

    /**
     * Export commodities data to Excel.
     */
    public function export(CommodityExportRequest $request)
    {
        $filename = 'daftar-barang-' . date('d-m-Y');

        return match ($request->extension) {
            'xlsx' => Excel::download(new CommoditiesExport, $filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX),
            'xls' => Excel::download(new CommoditiesExport, $filename . '.xls', \Maatwebsite\Excel\Excel::XLS),
            'csv' => Excel::download(new CommoditiesExport, $filename . '.csv', \Maatwebsite\Excel\Excel::CSV),
            'html' => Excel::download(new CommoditiesExport, $filename . '.html', \Maatwebsite\Excel\Excel::HTML),
        };
    }

}
