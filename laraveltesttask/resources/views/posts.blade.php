@extends('layout.layout')
@section('title', 'Posts')
@section('content')
	<div class="d-flex flex-column">
		<p><b>List of active users and their posts:</b></p>
		@foreach($data as $element)
		<div class="p-5 mb-5 common-section">
			<hr class="section-hr">
			<div class="title-common">Username: </div><i>{{$element['name']}}</i><br>
			<div class="title-common">Posts:<br></div>
			@if($element['posts'])
				@php
					$postcount = 1
				@endphp
				@foreach($element['posts'] as $post)
					<hr class="block-hr">
					<div class="common-block p-5">
						<b>№{{$postcount++}}</b> <br>
						{{$post['content']}} <br><br>
						<b>Created at:</b> {{$post['created_at']}}<br>
						<b>Number of comments on post: </b>{{$post['count_of_comments']}}<br>
						@if($post['url'])
							<img width="100" height="100" src="{{$post['url']}}">
						@endif
					</div>
					<hr class="block-hr">
				@endforeach
			@else <b>None</b>
			@endif
			<hr class="section-hr">
		</div>
		@endforeach
	</div>
@stop