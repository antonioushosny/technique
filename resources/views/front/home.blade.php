@extends('layouts.app')

@section('metatag')
	<title>{{ getMetaByKey('home') ? getMetaByKey('home')->translate()->metatags_title : __('lang.adam') }}</title>
	<meta name="description" content="{{ getMetaByKey('home') ? getMetaByKey('home')->translate()->metatags_desc :''}}">
 @endsection

@section('content')
 

@endsection

 
 
