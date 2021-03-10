<?php
namespace Modules\Admin\Http\Controllers\front;
 use Illuminate\Http\Request;
 use App\Http\Controllers\Controller;
 use Validator,Redirect,Response,File;
 use Socialite;
 use Modules\Admin\Models\Client;
 class SocialController extends Controller
 {
 public function redirect($provider)
 {
     return Socialite::driver($provider)->redirect();
 }
 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user(); 
   
   $user = $this->createUser($getInfo,$provider); 
   auth('client')->login($user); 
   return redirect()->to('/');
 }
 function createUser($getInfo,$provider){
  $device_token = isset($_COOKIE["device_token"]) ?  $_COOKIE["device_token"] :  ''   ;
//  dd($device_token) ;
 $user = Client::where('provider_id', $getInfo->id)->first();
    if (!$user) {
        $user = Client::create([
          'clients_name'     => $getInfo->name,
          'email'    => $getInfo->email,
          'provider' => $provider,
          'provider_id' => $getInfo->id
      ]);
    }
    $user->mobile_token  = $device_token ;
    $user->save();
   return $user;
 }
 }