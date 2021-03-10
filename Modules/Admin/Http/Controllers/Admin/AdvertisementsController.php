<?php

namespace Modules\Admin\Http\Controllers\Admin;
use App\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\AdvertisementRequest;
use Spatie\Permission\Models\Role;
use Modules\Admin\Models\Advertisement;
use Modules\Admin\Models\Language;

class AdvertisementsController extends Controller
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
            'advertisements_name' => [request('name'), 'like'], 
            'advertisements_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Advertisement::sorted();
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $advertisements = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.advertisements.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::admin.advertisements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\AdvertisementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request)
    {
        // dd($request->all());
        Advertisement::create($request->all());
        return redirect()->route('admin.advertisements.index')->with('status', __('admin::lang.advertisementCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement)
    {
        return view('admin::admin.advertisements.show', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $advertisement)
    {
        return view('admin::admin.advertisements.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Advertisement\Http\Requests\AdvertisementRequest  $request
     * @param  \Modules\Admin\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
    {
        // dd( $request->ar['']);
        $languages = Language::active()->get();
        foreach ($languages as $language) {
 
            if($request->file( $language->locale. '.advertisements_img')){
                $this->deleteFiles($advertisement->translate($language->locale)->advertisements_img) ;
            }
            if($request->file( $language->locale. '.advertisements_mobile_img')){
                $this->deleteFiles($advertisement->translate($language->locale)->advertisements_mobile_img) ;
            }
        }
        $advertisement->update($request->all());

        return redirect()->route('admin.advertisements.index')->with('status', __('admin::lang.advertisementUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Advertisement  $advertisement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return back()->with('status', __('admin::lang.advertisementDeleted'));
    }
}
