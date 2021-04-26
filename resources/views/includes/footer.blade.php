<!-- <footer class="text-muted py-5">
  <div class="container">
      <div class="row">
          <div class="col-md-3 text-left">
            <p class="float-end mb-1">
                <a href="#" class="btn btn-danger"> <i class="fa fa-arrow-up"></i> </a>
            </p>
          </div>
          <div class="col-md-9 text-right">
            <p class="mb-1">{{__('lang.copyRights')}} &copy; {{__('lang.reserved')}} {{date('Y')}} </p>
          </div>
      </div>
    
  </div>
</footer> -->

<div class="container-fluid bg-marine pt-3  " >
  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Grid row -->
    <div class="row ">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto ">

        <!-- Links -->
        <h5 class="font-weight-bold  font-16 col-white-op-70 text-uppercase  "> {{__('admin::lang.aboutus')}}</h5>

        <ul class="list-unstyled font-weight-normal p-1">
            <li>
                <a href="{{route('aboutUs')}}" class=" col-white-op-70 font-13" >{{__('admin::lang.aboutProject')}}</a>
            </li>
       
            <li>
                <a href="{{route('news')}}" class=" col-white-op-70 font-13" >{{__('admin::lang.news')}}</a>
            </li>
         
          
            <li>
                <a href="{{route('contactus')}}" class=" col-white-op-70 font-13" >{{__('lang.contactWithUs')}}</a>
            </li>

        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-75 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto   ">

        <!-- Links -->
        <h5 class="font-weight-bold font-16 col-white-op-70 text-uppercase ">{{__('lang.policies')}}</h5>

        <ul class="list-unstyled font-weight-normal p-1">
            <li>
                <a href="{{route('policy')}}" class=" col-white-op-70 font-13" >{{__('lang.policy')}}</a>
            </li>
            <li>
                <a href="{{route('terms')}}" class=" col-white-op-70 font-13" >{{__('admin::lang.termsConditions')}}</a>
            </li>
          
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-75 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto  ">

        <!-- Links -->
        <h5 class="font-weight-bold  font-16 col-white-op-70 text-uppercase d-none  ">{{__('lang.importLinks')}}</h5>

        <ul class="list-unstyled font-weight-normal p-1">
 
        </ul>


      </div>
      <!-- Grid column -->

      <hr class="clearfix w-75 d-md-none">
        <!-- Grid column -->
        <div class="col-md-3 mx-auto text-center">

            <!-- Links -->
            <h5 class="font-weight-bold  font-16 col-white-op-70 text-uppercase  ">{{__('lang.keepInTouch')}}</h5>

            <ul class="list-unstyled font-weight-normal p-1  ">

                <li class="">
                    <a href="{{isset($contacts) ? $contacts->contacts_facebook : ''}}" target="_blanck" class="text-decoration-none">
                        <span class="social-icons  font-30" > <i class="fa fa-facebook color-white"></i> <span>
                    </a>
                    <a href="{{isset($contacts) ? $contacts->contacts_twitter : ''}}" target="_blanck" class="text-decoration-none">
                        <span class="social-icons  font-30" > <i class="fa fa-twitter color-white"></i>  <span>
                    </a>
                    <a href="{{isset($contacts) ? $contacts->contacts_instagram : ''}}" target="_blanck" class="text-decoration-none">
                        <span class="social-icons font-30" > <i class="fa fa-instagram color-white"></i> <span>
                    </a>
                    <a href="{{isset($contacts) ? $contacts->contacts_snapchat: ''}}" target="_blanck" class="text-decoration-none">
                        <span class="social-icons  font-30" ><i class="fa fa-snapchat color-white"></i>  <span>
                    </a>
                    <a href="https://wa.me/{{isset($contacts) ? $contacts->contacts_whatsapp: ''}}" target="_blanck" class="text-decoration-none">
                        <span class="social-icons  font-30" ><i class="fa fa-whatsapp color-white"></i>  <span>
                    </a>

                </li>
              

            </ul>

        </div>
        <!-- Grid column -->


      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->
   
</div>
<!-- Footer -->
<div class="container-fluid bg-black py-4" id="footer-id" >


  <!-- Copyright -->
    <div class="container">
        <div class="row footer-copyright col-white-op-70 font-13 mb-4 text-center">
            <div class="col-md-12   col-12  " >
                &copy; <?php echo date('Y')." ".__('lang.rightsReserved')?></span>
            </div>
  
        </div>
    </div>
  <!-- Copyright -->
</div>

<!-- Footer -->
 <!-- old footer -->
<div class="container-fluid bg-black py-4 d-none " id="footer-id" >
    <div class="container ">

        <div class="row align-items-center ">
            <div class="col-12 mr-0 mb-md-0 mb-3 " >
                <a href="{{route('policy')}}" > <span class="statics-links col-white-op-70 mx-md-1 font-13" >   {{__('lang.policy')}}<span></a>
                <span class="color-lipstick font-13 mx-md-1">|</span>
                <a href="{{route('terms')}}" > <span class="statics-links col-white-op-70 mx-md-1 font-13" >   {{__('lang.terms')}} <span> </a>
                <span class="color-lipstick font-13 mx-md-1">|</span>
                <a href="{{route('contactus')}}" > <span class="statics-links col-white-op-70 mx-md-1 font-13" > {{__('lang.contactWithUs')}}<span> </a>
          
 

            </div>
            <div class="col-md-8 col-12 mr-0 col-white-op-70 font-13" >
                <span>{{__('lang.rightsReserved')}}   &copy; <?php echo date('Y'); ?> </span>
            </div>
            <div class="col-md-4 col-12 mr-0 col-white-op-70 font-13 pull-{{ $dir == 'ltr' ? 'right' : 'left' }}">
                <span class="copper-color fb-500">{{ __('lang.copyrightText') }}   </span>
                <a href="#" target="_blank">
                    <img src="{{ $dir == 'ltr' ? asset('front/images/logo.png') : asset('front/images/logo.png') }}  " class="img-fluid p{{ $dir == 'ltr' ? 'l' : 'r' }}-2" alt="" width="100px">
                </a>
    	    </div>
         </div>
    </div>
</div>
