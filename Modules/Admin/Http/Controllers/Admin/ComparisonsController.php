<?php

namespace Modules\Admin\Http\Controllers\Admin;
use App\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\ComparisonRequest;
use Modules\Admin\Models\Comparison;
use Modules\Admin\Models\Language;

class ComparisonsController extends Controller
{
        use StorageHandle;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'comparisons_title' => [request('name'), 'like'], 
            'comparisons_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Comparison::sorted();
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $comparisons = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.comparisons.index', compact('comparisons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::admin.comparisons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\ComparisonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComparisonRequest $request)
    {
        Comparison::create($request->all());
        return redirect()->route('admin.comparisons.index')->with('status', __('admin::lang.comparisonCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $comparison
     * @return \Illuminate\Http\Response
     */
    public function show(Comparison $comparison)
    {
        return view('admin::admin.comparisons.show', compact('comparison'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Comparison  $comparison
     * @return \Illuminate\Http\Response
     */
    public function edit(Comparison $comparison)
    {
        return view('admin::admin.comparisons.edit', compact('comparison'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Comparison\Http\Requests\ComparisonRequest  $request
     * @param  \Modules\Admin\Models\Comparison  $comparison
     * @return \Illuminate\Http\Response
     */
    public function update(ComparisonRequest $request, Comparison $comparison)
    {
        $comparison->update($request->all());
        return redirect()->route('admin.comparisons.index')->with('status', __('admin::lang.comparisonUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Comparison  $comparison
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comparison $comparison)
    {
        $comparison->delete();
        return back()->with('status', __('admin::lang.comparisonDeleted'));
    }
}
