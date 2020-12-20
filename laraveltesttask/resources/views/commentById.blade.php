@php
$data = json_decode($data, true);
$commentCounter = 1;
@endphp
@extends('layout.layout')
@section('title', 'Comments')
@section('content')
	<div class="d-flex flex-column">
		<p><b>List of user's comments:</b></p>
			<div class="p-5 mb-5 common-section">
			<div class="title-common">
				User: {{$data['username']}} <br>
				User's Comments: <br>
			</div>
			@foreach($data['comments'] as $comment)
				<hr class="block-hr">
				<div class="common-block p-5">
					<b>№{{$commentCounter++}} Date: {{$comment['created_at']}} </b><br>
					{{$comment['content']}} <br> <br>
					<b>Comment`s post:</b> <br>
					{{$comment['post']['content']}}<br>
					<img width="100" height="100" src="{{$comment['image_url']}}"><br>
					<b>Post's author: </b>@php $author = $comment['post']['author']['active'] ? $comment['post']['author']['name'] : "Author is inactive at the moment";@endphp {{$author}}
				</div>
				<hr class="block-hr">
			@endforeach
		</div>
	</div>
@stop