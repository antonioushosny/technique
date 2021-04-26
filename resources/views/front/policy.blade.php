@extends('layouts.app')

@section('metatag')

    <title>{{ getMetaByKey('privacy_policy') ? getMetaByKey('privacy_policy')->translate()->metatags_title : __('lang.policy') }}</title>

    <meta name="description" content="{{ getMetaByKey('privacy_policy') ? getMetaByKey('privacy_policy')->translate()->metatags_desc : '' }}">

@endsection

@section('content')




{{-- Breadcrumb Section --}}
    <div class="container p-0">
        <ol class="breadcrumb bg-white">
        <li class="breadcrumb-item"><a href="{{route('home')}}" class=" color-bluish"> {{ __('admin::lang.home') }}</a> </li>
        <li class="breadcrumb-item  "><a href="" class=" color-greyish-brown">   {{ __('lang.policy') }}</a> </li>
        </ol>
	</div>
{{-- End BreadCrumb --}}


<section class="container about-details mt-2 mt-md-2 ">

	<h4 class="fb-800 sycamore-color mb-2 mb-md-4 text-center d-none">
		{!! $policy->translate()->infos_title !!}
	</h4>


	<div class="fb-500 gray-color">
		{!! $policy->translate()->infos_desc !!}
	</div>

</section>



@endsection
