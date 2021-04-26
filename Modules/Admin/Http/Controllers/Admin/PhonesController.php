<?php

namespace Modules\Admin\Http\Controllers\Admin;
use App\Models\StorageHandle;

use App\Http\Controllers\Controller;
use Modules\Admin\Http\Requests\PhoneRequest;
use Modules\Admin\Http\Requests\PhoneComparisonsRequest;
use Modules\Admin\Models\Phone;
use Modules\Admin\Models\Language;
use Modules\Admin\Models\PhoneComparison;
use Modules\Admin\Models\Comparison;


class PhonesController extends Controller
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
            'phones_title' => [request('name'), 'like'], 
            'phones_status' => [request('status'), '=']
        ];
        request()->flash();

        $query = Phone::sorted();
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $phones = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::admin.phones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Admin\Http\Requests\PhoneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhoneRequest $request)
    {
        Phone::create($request->all());
        return redirect()->route('admin.phones.index')->with('status', __('admin::lang.phoneCreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\Admin  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        return view('admin::admin.phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Modules\Admin\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        return view('admin::admin.phones.edit', compact('phone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Phone\Http\Requests\PhoneRequest  $request
     * @param  \Modules\Admin\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(PhoneRequest $request, Phone $phone)
    {
        if($request->phones_image){
            $this->deleteFiles($phone->phones_image) ;
        }
        $phone->update($request->all());
        return redirect()->route('admin.phones.index')->with('status', __('admin::lang.phoneUpdated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        $this->deleteFiles($phone->phones_image) ;
        $phone->delete();
        return back()->with('status', __('admin::lang.phoneDeleted'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function comparisons(Phone $phone)
    {
        $comparisons = Comparison::all();
        return view('admin::admin.phones.comparisons', compact('phone','comparisons'));
    }
    

     /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Phone\Http\Requests\PhoneRequest  $request
     * @param  \Modules\Admin\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function saveComparisons(PhoneComparisonsRequest $request)
    {
        // return $request ;
        foreach($request->comparisons_id as $key => $comparisons_id){
            $phoneComparison = PhoneComparison::where('phones_id',$request->phones_id)->where('comparisons_id',$comparisons_id)->first();
            if(!$phoneComparison){
                $phoneComparison = new PhoneComparison ;
                $phoneComparison->phones_id = $request->phones_id ;
                $phoneComparison->comparisons_id = $comparisons_id ;
                $phoneComparison->save();
                $phoneComparison->trans()->create([
                    'locale'             => 'ar',
                    'phones_comparisons_text'   => $request['phones_comparisons_text_ar'][$key],
                ]);
                $phoneComparison->trans()->create([
                    'locale'                    => 'en',
                    'phones_comparisons_text'   => $request['phones_comparisons_text_en'][$key],
                ]);
            }else{
                $phoneComparison->trans()->where('locale','ar')->update([
                    'phones_comparisons_text'   => $request['phones_comparisons_text_ar'][$key],
                ]);
                $phoneComparison->trans()->where('locale','en')->update([
                    'phones_comparisons_text'   => $request['phones_comparisons_text_en'][$key],
                ]);
            }
        
        }
 
        return redirect()->route('admin.phones.index')->with('status', __('admin::lang.phoneComparisonUpdated'));
    }
    
}
