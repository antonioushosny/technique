<?php

namespace Modules\Admin\Http\Controllers\Admin;
use App\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\NewsRequest;
use Modules\Admin\Models\News;
use Modules\Admin\Models\Language;

class NewsController extends Controller
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
            'news_title' => [request('name'), 'like'], 
            'news_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = News::sorted();
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $news = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\NewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        News::create($request->all());
        return redirect()->route('admin.news.index')->with('status', __('admin::lang.newCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $new
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new = News::findOrFail($id);
        return view('admin::admin.news.show', compact('new'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = News::findOrFail($id);
        return view('admin::admin.news.edit', compact('new'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\News\Http\Requests\NewsRequest  $request
     * @param  \Modules\Admin\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $new = News::findOrFail($id);
        if($request->news_image){
            $this->deleteFiles($new->news_image) ;
        }
        $new->update($request->all());

        return redirect()->route('admin.news.index')->with('status', __('admin::lang.newUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\News  $new
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $new = News::findOrFail($id);
        $this->deleteFiles($new->news_image) ;
        $new->delete();
        return back()->with('status', __('admin::lang.newDeleted'));
    }
}
