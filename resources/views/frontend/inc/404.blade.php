@extends('frontend.layout.master')
@section('title', 'Not Found')
@section('keyword', 'Not Found')
@section('description', 'Not Found')

@section('contant')
<div class="session pt-90 pb-80 sm-pt-50 sm-pb-50">
	<div class="container">
		
		<div class="call-do-action-content text-center">
			<div class="text-white-head">404</div>
			<div class="sub-title">OOPS... PAGE NOT FOUND!</div>		

			<p class="text-white-p">Try using the button below to go to main page of the site</p>
			<div class="mt-40">
				<a href="{{route('home')}}" class="btn-common btn-cda" >Back To Home Page</a>
			</div>
		</div>
	</div>
</div>


@stop