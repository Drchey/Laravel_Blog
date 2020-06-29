@extends('main')
<?php 
$titleTag = htmlspecialchars($post->title);
?>
@section('title', "| $titleTag")
@section('content')

        <div class="row">
            <div class="col-md-9 col-md-offset-1">
              <h1 class="center">{{ucfirst($post->title)}}</h1>
 
              <p>{!!$post->body!!}</p>

              <img src="{{asset('images/'.$post->image) }}" >
              <br>

              <p>Posted In: -- {{ucfirst($post->category->name)}} Category</p>
               
            </div>
        </div>

        <div class="row">
        	<div class="col-md-9 col-md-offset-1">
        		<h3 class="comment-title">
        			<span class="octicon report" ></span>{{$post->comments()->count() }} Comments</h3>
        		@foreach($post->comments as $comment)
        			<div class="comment">
        				<div class="author-info">
        				<img src="{{'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))). '?s=506d=mm'}}"  class="author-image img-rounded">
        				<div class="author-name">
        				<h4>{{$comment->name}}</h4> 

        				<p class="author-time">{{date('F n, Y -g:iA', strtotime($comment->created_at))}}</p>
        				</div>
        			</div>
        				<div class="comment-content">
        				{{$comment->comment}}       
        				</div>
        			</div>
        			<hr>
        		@endforeach 
        	</div>
        </div>
        
        <div class="row">
        	<div id="comment-form" class="col-md-9 col-md-offset-1" style="margin-top:50px;">
        		{{Form::open(['route'=>['comments.store',$post->id], 'method'=>'POST'])}}

        		<div class="row">
        			<div class="col-md-6">
        				{{Form::label('name', 'Name')}}
        				{{Form::text('name', null, ['class' =>'form-control'])}}
        			</div>
        			<div class="col-md-6">
        				{{Form::label('email', 'Email')}}
        				{{Form::text('email', null, ['class' =>'form-control'])}}
        			</div>
        			<br>
        			<div class="col-md-12">
        				{{Form::label('comment', 'Comment')}}
        				{{Form::textarea('comment', null, ['class' =>'form-control', 'rows'=>'5'])}}

        				{{Form::submit('Add Comment', ['class'=>'btn btn-success btn-block', 'style'=>'margin-top:15px;' ])}}
        			</div>
        		</div>
        			{{Form::close()}}
        	</div>
        </div>




        
@endsection

