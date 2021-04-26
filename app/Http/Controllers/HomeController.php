<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Modules\Admin\Models\Advertisement;
use Modules\Admin\Models\News;
use Modules\Admin\Models\Video;
use Modules\Admin\Models\Phone;
use Modules\Admin\Models\Comparison;
use Carbon\Carbon;
use Module ;
class HomeController extends Controller
{
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   
        $last_news = News::active()->limit(3)->get();
        $videos = Video::active()->limit(3)->get();
        $phones = Phone::active()->limit(6)->get();
        $mainPageTitle = 'home' ;
        return view('front.home',compact('mainPageTitle','last_news','videos','phones'));
    }
 
    public function news(Request $request)
    {   
        $news = News::active()->paginate(9);
        $mainPageTitle = 'news' ;
        return view('front.news',compact('mainPageTitle','news'));
    }
    public function showNews(News $news)
    {   
        $mainPageTitle = 'news' ;
        return view('front.showNews',compact('mainPageTitle','news'));
    }

    public function videos(Request $request)
    {   
        $videos = Video::active()->paginate(9);
        $mainPageTitle = 'videos' ;
        return view('front.videos',compact('mainPageTitle','videos'));
    }

    public function phones(Request $request)
    {   
        $phones = Phone::active()->paginate(9);
        $mainPageTitle = 'phones' ;
        return view('front.phones',compact('mainPageTitle','phones'));
    }

    public function comparisons(Request $request)
    {   
        $comparisons = Comparison::active()->paginate(9);
        $phones = Phone::active()->get()->pluck('phones_title','phones_id');
        $phone1 = null ;
        $phone2 = null ;
        if(request()->phones_id){
            $phone1 = Phone::find(request()->phones_id);
        }
        if(request()->phones_id2){
            $phone2 = Phone::find(request()->phones_id2);
        }
        $mainPageTitle = 'comparisons' ;
        return view('front.comparisons',compact('mainPageTitle','comparisons','phone1','phone2','phones'));
    }
}
