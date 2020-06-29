@extends('main')
@section('title', "| $tag->name")
@section('content')
	<div class="row">
		<div class="col-md-8">
			<h2>{{$tag->name}} Tag  <small>{{$tag->posts()->count() }} Post(s)</small></h2>
		</div>
		<div class="col-md-2 ">
			<a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary pull-right btn-block" style="margin: 20px;">EDIT</a>
		</div>
		<div class="col-md-2">
			{{Form::open(['route'=>['tags.destroy', $tag->id], 'method' =>'DELETE']) }}
			{{Form::submit('DELETE', ['class'=>'btn btn-danger btn-block', 'style'=>'margin-top:20px;'])}}
			{{Form::close()}}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>Title</th>
						<th>Tags</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
					<tr>
						<th>{{$post->title}}</th>
						<td>{{$post->updated_at}}</td>	
						<td>@foreach($post->tags as $tag)
							<span class="label label-default" style="margin:5px;">{{$tag->name}}
							</span>
							@endforeach
						</td>
						<td><a href="{{route('posts.show',$post->id)}}" class="btn-default btn-xs">View</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	

@endsection