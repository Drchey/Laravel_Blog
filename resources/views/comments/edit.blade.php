@extends('main')

@section('title', '| Edit Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<h2>Edit Comment</h2>
		{{Form::model($comment, ['route' =>['comments.update',$comment->id], 'method'=>'PUT']) }}

		{{Form::label('name', 'Name')}}
		{{Form::text('name', null, ['class'=>'form-control form-spacing top', 'disabled' =>'']) }}

		{{Form::label('name', 'Email')}}
		{{Form::text('email', null, ['class'=>'form-control form-spacing top', 'disabled' =>'']) }}

		{{Form::label('comment', 'Comment')}}
		{{Form::textarea('comment', null, ['class'=>'form-control form-spacing top']) }}

		{{Form::submit('Update Comment', ['class'=> 'btn btn-block btn-success', 'style'=> 'margin-top:15px;']) }}



		{{Form::close()}}
	</div>
	</div>


@endsection

