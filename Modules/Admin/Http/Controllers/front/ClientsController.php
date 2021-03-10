<?php

namespace Modules\Admin\Http\Controllers\front;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Models\City;
use Modules\Admin\Models\Client;
use Modules\Admin\Models\ClientAddresses;
 use Auth ;
 use Modules\Admin\Http\Requests\ClientAddressesRequest;

 
class ClientsController extends Controller
{

    /**
     * Show the favorite page .
     *
     * @return \Illuminate\Http\Response
     */
  
    public function addresses()
    {
        if(auth::guard('shop')->check()){
             return redirect()->route('shopProfile');
        }

        if(auth('client')->check() ){
            $addresses = ClientAddresses::where('clients_id',auth('client')->user()->clients_id )->with('city')->get() ; 
            // return $addresses ;
            $mainPageTitle = 'myAddresses';
 
            return view('admin::front.clients.myaddresses', compact('addresses','mainPageTitle'));
        }
         return redirect()->route('login');
    }

    public function addAddress()
    {
 
        $cities  =City::where('cities_status','1')->get();
        $cities  = $cities->pluck('cities_name','cities_id');

        $mainPageTitle = 'myAddresses' ;
        $type = "addresses" ;
        return view('admin::front.clients.addAddress',compact('mainPageTitle','cities','type'));
    }

    public function addAddresses()
    {
 
        $cities  =City::where('cities_status','1')->get();
        $cities  = $cities->pluck('cities_name','cities_id');

        $mainPageTitle = 'myAddresses' ;
        $type = "cart";
        return view('admin::front.clients.addAddress',compact('mainPageTitle','cities','type'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAddress(ClientAddressesRequest $request)
    {
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyA-A44M149_C_j4zWAZ8rTCFRwvtZzAOBE&latlng='.$request->lat.','.$request->lng.'&sensor=false');
        $output= json_decode($geocode);
        $city   = City::where('cities_code','')->first();   
        // return $city ;
        if($city){
            $request->cities_id = $city->cities_id ;
        }
        if($output->status == "OK"){
           $cityName = $output->results[0]->address_components[3]->long_name  ;
           $city   = City::where('name','like','%'.$cityName.'%')->first();
           if($city){
               $request->cities_id = $city->cities_id ;
           } 
        } 
  
        $address = ClientAddresses::create($request->all());
        $address->cities_id = $request->cities_id ;
        $address->save();
        if($request->lat && $request->lng){
            $arr = [] ;
            $arr[0] = $request->lat ;
            $arr[1] = $request->lng ;
            $arr = json_encode($arr) ;
            $address->client_addresses_gps  = $arr  ;
            $address->save() ; 
        }
        if($request->type && $request->type == 'cart'){
            return redirect()->route('cart')->with('success', __('lang.save_successfuly'));
        }
        return back()->with('success', __('lang.save_successfuly'));
         
    }


    public function editAddress($id)
    {
 
        $cities  = City::where('cities_status','1')->get();
        $cities  = $cities->pluck('cities_name','cities_id');
        $address = ClientAddresses::findOrFail($id) ;
        $addresses_gps = json_decode($address->client_addresses_gps) ;
        $mainPageTitle = 'myAddresses' ;
        return view('admin::front.clients.editAddress',compact('mainPageTitle','cities','address','addresses_gps'));
    }
 
    public function updateAddress(ClientAddressesRequest $request, $id)
    {   
        $geocode=file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyA-A44M149_C_j4zWAZ8rTCFRwvtZzAOBE&latlng='.$request->lat.','.$request->lng.'&sensor=false');
        $output= json_decode($geocode);
        $city   = City::where('cities_code','')->first();
        // return $city ;
        if($city){
            $request->cities_id = $city->cities_id ;
        }
        if($output->status == "OK"){
            // dd($output->results[0]);
            $cityName = $output->results[0]->address_components[3]->long_name  ;
            $city   = City::where('name','like','%'.$cityName.'%')->first();
            // return $city ;
           if($city){
               $request->cities_id = $city->cities_id ;
           } 
        } 
        // return  $request->cities_id ;
         $address = ClientAddresses::findOrFail($id) ;
        if($address){
            $address->update($request->all());
            $address->cities_id = $request->cities_id ;
            $address->save();
            if($request->lat && $request->lng){
            $arr = [] ;
            $arr[0] = $request->lat ;
            $arr[1] = $request->lng ;
            $arr = json_encode($arr) ;
            $address->client_addresses_gps  = $arr  ;
            $address->save() ; 
        }
        }

        return back()->with('success', __('lang.edit_successfuly'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAddress($id)
    {
        $address = ClientAddresses::findOrFail($id) ;
        if($address){
           $address->delete() ;
        }
        return back()->with('success', __('lang.delete_successfully'));
    }


    /**
     * add to  favorite  .
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        if(auth::guard('shop')->check()){
             return redirect()->route('shopProfile');
        }

        $favorite =  Favorite::where('clients_id',auth('client')->user()->clients_id)->where('products_id',$id)->first() ; 
        if($favorite){
            $favorite->delete() ;
            return redirect()->back()->with('success', __('lang.Deleted_from_favorite'));  
        }else{
            $favorite = new Favorite ;
            $favorite->clients_id = auth('client')->user()->clients_id ; 
            $favorite->products_id = $id ; 
            $favorite->save() ;
            return redirect()->back()->with('success', __('lang.addedToFavorite'));       
        }
       
        return redirect()->back()->with('success', __('lang.addedToFavorite'));             
    }

    public static  function getCountFavorite(){
        if(auth::guard('shop')->check()){
             return redirect()->route('shopProfile');
        }
        
        if(auth('client')->check()){
            $countFavorite = Favorite::Where('clients_id',auth('client')->user()->clients_id)->count();
        }else{
            $countFavorite = 0 ;
        }
        return $countFavorite ;
    }
    
}
