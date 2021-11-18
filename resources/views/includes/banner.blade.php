<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        @foreach($advertisements as $key => $advertisement)
        <li data-target="#demo" data-slide-to="{{$key}}" class="{{$loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        @foreach($advertisements as $advertisement)
        <div class="carousel-item {{$loop->first ? 'active' : '' }}">
            @if($agent->isPhone())
            <img src="{{$advertisement->advertisements_mobile_img ? asset($advertisement->images_url($advertisement->advertisements_mobile_img, 'original')) : asset('img/no-image.png')}}" class="img-contain contain-img"   height="500">
            @else 
            <img src="{{$advertisement->advertisements_img ? asset($advertisement->images_url($advertisement->advertisements_img, 'original')) : asset('img/no-image.png')}}"  class="img-contain contain-img" height="300">
            @endif
        </div>
        @endforeach
        
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

 