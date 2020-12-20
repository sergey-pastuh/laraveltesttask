@extends('layout.layout')
@section('title', 'Comments')
@section('content')
		<div class="d-flex flex-column">
			<p><b>Click on user to see their comments:</b></p>
			@foreach($data as $user)
				<a href="comments/{{$user['id']}}">{{$user['name']}}</a><br>
			@endforeach
		</div>
@stop