<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}">{{__('admin::lang.siteTitle')}}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
 
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item {{$mainPageTitle == 'home' ? 'active' : '' }} ">
        <a class="nav-link" href="{{route('home')}}">{{__('lang.home')}} <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{$mainPageTitle == 'phones' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('phones')}}">{{__('admin::lang.phones')}}</a>
      </li>
      <li class="nav-item {{$mainPageTitle == 'news' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('news')}}">{{__('admin::lang.news')}}</a>
      </li>
      <li class="nav-item {{$mainPageTitle == 'videos' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('videos')}}">{{__('admin::lang.videos')}}</a>
      </li>
      <li class="nav-item {{$mainPageTitle == 'comparisons' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('comparisons')}}">{{__('admin::lang.comparisons')}}</a>
      </li>

      
    </ul>
    <form class="form-inline my-2 my-lg-0 ">
        <a class="color-white" href="{{$locale == 'ar' ? route('lang','en') : route('lang','ar')}}"  >{{ $locale == 'ar' ? 'English' : 'عربي'}}</a>
    </form>
  </div>

  </div>
</nav>