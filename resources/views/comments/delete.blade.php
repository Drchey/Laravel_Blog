@extends('main')

@section('title', '| Delete Comment ?')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well">
			<h1>Are You Sure You Want to Delete ?</h1>
			<p>
				<strong>Name  </strong>{{$comment->name}}
			</p>
			<p>
				<strong>Email  </strong>{{$comment->email}}
				
			</p>
				<strong>Comment</strong>
				<p>
				{{$comment->comment}}
					
				</p>
			</p>
				
			{{Form::open(['route'=>['comments.destroy',$comment->id],'method'=>'DELETE'])}}
			{{Form::submit('DELETE COMMENT', ['class'=>'btn btn-danger btn-block btn-lg', 'style'=>'margin-top:45px;'])}}
		</div>
		</div>
	</div>



@endsection

