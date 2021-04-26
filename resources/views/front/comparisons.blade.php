@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('phones') ? getMetaByKey('phones')->translate()->metatags_title :  __('admin::lang.phones') }}</title>
	<meta name="description" content="{{ getMetaByKey('phones') ? getMetaByKey('phones')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
@include('includes.banner')

<section class="py-5 text-center container">
	<div class="row py-lg-5">
      	<div class="col-lg-6 col-md-8 mx-auto">
        	<h1 class="fw-light">{{__('admin::lang.comparisons')}}</h1>
		</div>
	</div>
    <form action="{{route('comparisons')}}" type="get">
	<div class="row card-header">
            @csrf 
            <div class="col-md-4 mb-1"> <strong>{{ __('admin::lang.comparisons_title') }}</strong> </div>
            <div class="col-md-3 mb-1">{{Form::select('phones_id', $phones,isset($phone1) ? $phone1->phones_id  : '',["class"=>"form-control select2","placeholder"=>__('admin::lang.phone')])}} </div>
            <div class="col-md-3 mb-1">{{Form::select('phones_id2', $phones,isset($phone2) ? $phone2->phones_id  : '',["class"=>"form-control select2","placeholder"=>__('admin::lang.phone')])}} </div>
            <div class="col-md-2 mb-1"> <button type="submit" class="btn btn-success">{{__('lang.compare')}}</button> </div>
            
        </div>
    </form>
    @foreach($comparisons as $comparison)
    <div class="row">
        <div class="col-lg-12">
        <div class="form-group row">
            <span class="col-md-4 col-4 col-form-label">{{ $comparison->comparisons_title }}</span>
            <span class="col-md-3 col-4 col-form-label">{{ $phone1 && getPhoneComparison($phone1->phones_id,$comparison->comparisons_id) ? getPhoneComparison($phone1->phones_id,$comparison->comparisons_id)->phones_comparisons_text : ''  }}</span>
            <span class="col-md-3 col-4 col-form-label">{{ $phone2 && getPhoneComparison($phone2->phones_id,$comparison->comparisons_id) ? getPhoneComparison($phone2->phones_id,$comparison->comparisons_id)->phones_comparisons_text : ''  }}</span>
        </div>
        <hr/>

        </div>
    </div>
    @endforeach
</section>

 
@endsection

 
 
