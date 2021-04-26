<?php

namespace Modules\Admin\Http\Controllers\Admin;
use App\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\VideoRequest;
use Modules\Admin\Models\Video;
use Modules\Admin\Models\Language;

class VideosController extends Controller
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
            'videos_title' => [request('name'), 'like'], 
            'videos_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Video::sorted();
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $videos = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\VideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        Video::create($request->all());
        return redirect()->route('admin.videos.index')->with('status', __('admin::lang.videoCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('admin::admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('admin::admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Video\Http\Requests\VideoRequest  $request
     * @param  \Modules\Admin\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(VideoRequest $request, Video $video)
    {
        $video->update($request->all());
        return redirect()->route('admin.videos.index')->with('status', __('admin::lang.videoUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('status', __('admin::lang.videoDeleted'));
    }
}
