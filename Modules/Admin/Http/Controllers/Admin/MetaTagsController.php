<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\MetaTagRequest;

use Modules\Admin\Models\MetaTag;

class MetaTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchArray = [
            'metatags.metatags_page' => [request('page'), 'like'], 
            'metatag_translations.metatags_title' => [request('title'), 'like'], 
            'metatag_translations.metatags_desc' => [request('desc'), 'like'], 
        ];
        request()->flash();

        $query = MetaTag::where('metatags.metatags_page', '!=', null)->join('metatag_translations', 'metatags.metatags_id', 'metatag_translations.metatags_id')
        ->groupBy('metatags.metatags_id')
        ->sorted();


        $searchQuery = $this->searchIndex($query, $searchArray);
        $metatags = $searchQuery->paginate(env('PerPage'));
        
        return view('admin::admin.metatags.index', compact('metatags'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\MetaTag  $metatag
     * @return \Illuminate\Http\Response
     */
    public function show(MetaTag $metatag)
    {
        request()->flash();
        return view('admin::admin.metatags.show', compact('metatag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\MetaTag  $metatag
     * @return \Illuminate\Http\Response
     */
    public function edit(MetaTag $metatag)
    {
        request()->flash();

        return view('admin::admin.metatags.edit', compact('metatag'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\MetaTagReques  $request
     * @param  \Modules\Admin\Models\MetaTag  $metatag
     * @return \Illuminate\Http\Response
     */
    public function update(MetaTagRequest $request, MetaTag $metatag)
    {
        // Update MetaTag
        $metatag->update($request->all());

        return redirect()->route('admin.metatags.index')->with('status', __('admin::lang.metatagUpdated'));
    }

}
