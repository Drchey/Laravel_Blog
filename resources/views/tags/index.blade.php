@extends('main')
@section('title', '| Tags')
@section('content')

<div class="row">
	<div class="col-md-8">
		<h1>Tags</h1>
		<table class="table" >
			<thead>
				<tr>
					<!-- <th>#</th> -->
					<th>Name</th>
					<th>Updated_at</th> 
				</tr>
			</thead>
			<tbody>
				@foreach($tags as $tag)
				<tr>
					<td><a href="{{route('tags.show', $tag->id)}}">{{$tag->name}}</a></td>
					<td>{{$tag->updated_at}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="col-md-3 col-md-offset-1">
		<div class="well">
			{!!Form::open(['route'=>'tags.store', 'method'=>'POST'])!!}
			
			<h2>New Tag</h2>

			{{Form::label('name', 'Name')}}
			{{Form::text('name', null, ['class' =>'form-control'] )}}

			{{Form::submit('Create New Tag', ['class' =>'btn btn-primary btn-block btn-h1-spacing'])}}

			{!!Form::close()!!}
		</div>
	</div>
</div>


@endsection


