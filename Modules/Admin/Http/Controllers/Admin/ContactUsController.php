<?php

namespace Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Modules\Admin\Models\ContactUs;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $searchArray = [
            'contact_us_name' => [request('name'), 'like'],
            'contact_us_type' => [request('type'), '='],
            'contact_us_status' => [request('status'), '=']
        ];
        // dd($searchArray);

        request()->flash();

        $query = ContactUs::orderBy('contact_us_id','Desc');
        
        $searchQuery = $this->searchIndex($query, $searchArray);
        $contactus = $searchQuery->paginate(env('PerPage'));

        return view('admin::admin.contactus.index', compact('contactus'));
    }
    /**
     * get Count new ContactUs  .
     *
     * @return \Illuminate\Http\Response
     */
    public static  function getCountContactUs(){
 
        $CountContactUs = ContactUs::where('contact_us_status','0')->count('contact_us_id');
        return $CountContactUs ;
    }
    /**
     * Display the specified resource.
     *
     * @param  \Modules\Admin\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show(ContactUs $contactus)
    {
        return view('admin::admin.contactus.show', compact('contactus'));
    }
     
     /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\ContactUs  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactus)
    {
        
        $contactus->contact_us_status = '1' ;
        $contactus->save();
        
        return back()->with('status', __('admin::lang.updatedDone'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Modules\Admin\Models\ContactUs  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactus)
    {
        
        $contactus->delete();
        
        return back()->with('status', __('admin::lang.contactusDeleted'));
    }

}
