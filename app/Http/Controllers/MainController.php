<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use Auth;

use Modules\Admin\Models\Client;
use Modules\Admin\Models\Advertisement;
use Modules\Admin\Models\Info;
use Modules\Admin\Models\ContactUs;
use Modules\Admin\Models\Contact;
use Modules\Admin\Models\Notification;
use Carbon\Carbon;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use App\Notifications\VerfiyMail;
class MainController extends Controller
{
 
 

  /**
     * Show the shop aboutUs.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutUs(Request $request)
    {
 

        $aboutText  = Info::where('infos_key','about')->first();
        $mainPageTitle = 'aboutUs' ;
        // return $aboutText ;
        $previous_url = $request->path();
        if(strpos($previous_url, 'mobile') !== false){
            $data = [] ;
            $data['aboutText'] = $aboutText;
            return response()->json($data);
        }
        return view('front.about', compact('mainPageTitle','aboutText'));
    }

    /**
     * Show the terms.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms(Request $request)
    {
 
        $terms  = Info::where('infos_key','terms')->first();
        $mainPageTitle = 'terms' ;
 
        return view('front.terms', compact('mainPageTitle','terms'));
    }

    /**
     * Show the terms.
     *
     * @return \Illuminate\Http\Response
     */
    public function policy(Request $request)
    {
 
        $policy  = Info::where('infos_key','policy')->first();
        $mainPageTitle = 'policy' ;
        // return $aboutText ;
 
        return view('front.policy', compact('mainPageTitle','policy'));
    }
 

    public function ContactUs(){
        
        $contacts = Contact::first() ;
        // return $contacts ;
        $mainPageTitle = 'contactus' ;

        return view('front.contactUs', compact('mainPageTitle','contacts'));

    }

    public function addcontactus(ContactUsRequest $request)
    {
        // dd($request->all());
        ContactUs::create($request->all());

        return back()->with('success', __('lang.sendSuccessfuly'));
    }

   

 }
