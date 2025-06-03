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
use App\Models\Ruang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
    private function applyFilters($query, Request $request)
    {
        // Filter by search term (name, item_code, brand)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('item_code', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('material', 'LIKE', "%{$search}%");
            });
        }

        // Filter by commodity location
        if ($request->filled('commodity_location_id')) {
            $query->where('commodity_location_id', $request->commodity_location_id);
        }

        // Filter by commodity acquisition
        if ($request->filled('commodity_acquisition_id')) {
            $query->where('commodity_acquisition_id', $request->commodity_acquisition_id);
        }

        // Filter by condition
        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Filter by material
        if ($request->filled('material')) {
            $query->where('material', $request->material);
        }

        // Filter by year of purchase range
        if ($request->filled('year_from')) {
            $query->where('year_of_purchase', '>=', $request->year_from);
        }

        if ($request->filled('year_to')) {
            $query->where('year_of_purchase', '<=', $request->year_to);
        }

        // Filter by price range
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Filter by quantity range
        if ($request->filled('quantity_from')) {
            $query->where('quantity', '>=', $request->quantity_from);
        }

        if ($request->filled('quantity_to')) {
            $query->where('quantity', '<=', $request->quantity_to);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Validate sort parameters
        $allowedSortFields = [
            'name',
            'item_code',
            'brand',
            'material',
            'year_of_purchase',
            'condition',
            'quantity',
            'price',
            'price_per_item',
            'created_at'
        ];

        if (in_array($sortBy, $allowedSortFields)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        }
    }

    /**
     * Get filter options for dropdowns
     */
    private function getFilterOptions()
    {
        return [
            'brands' => Commodity::select('brand')
                ->distinct()
                ->whereNotNull('brand')
                ->where('brand', '!=', '')
                ->orderBy('brand')
                ->pluck('brand'),

            'materials' => Commodity::select('material')
                ->distinct()
                ->whereNotNull('material')
                ->where('material', '!=', '')
                ->orderBy('material')
                ->pluck('material'),

            'years' => Commodity::select('year_of_purchase')
                ->distinct()
                ->whereNotNull('year_of_purchase')
                ->orderBy('year_of_purchase', 'desc')
                ->pluck('year_of_purchase'),

            'conditions' => [
                1 => 'Baik',
                2 => 'Kurang Baik',
                3 => 'Rusak Berat'
            ]
        ];
    }

    /**
     * Export filtered commodities (optional method)
     */
    public function export(Request $request)
    {
        $query = Commodity::with(['commodity_location', 'commodity_acquisition']);
        $this->applyFilters($query, $request);
        $commodities = $query->get();

        // Export logic here (Excel, PDF, etc.)
        // Return export file
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
}
