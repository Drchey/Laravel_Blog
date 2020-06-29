@extends('main')

@section('title', '| Create Post')

{{Html::script('../js/tinymce.min.js')}}
{{Html::style('css/select2.min.css')}}

<script type="text/javascript">
    tinymce.init({
        selector:'textarea',
        plugins: 'link code',
        menubar:false,
    });
</script>

@section('content')


<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1>Create New Post</h1>
		<hr>

		{!! Form::open(['route' => 'posts.store', 'data-parsley-validate' =>'','files' =>true ]) !!}

    	{{ Form::label('title', 'Title ', ['style'=>'margin-top:20px;'])}}
    	{{ Form::text('title', null, array('class' =>'form-control', 'required' =>'', 'maxlength'=>'255'))}}
    	

        {{Form::label('slug', 'Slug')}}
        {{Form::text('slug', null, array('class' =>'form-control', 'required'=>  '', 'min' =>'5', 'max' =>'255') ) }}
        
  

        {{ Form::label('category_id', 'Category', ['style'=>'margin-top:20px;'])}}
        <select class="form-control" name="category_id">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
        </select>
        

         {{ Form::label('tags ', 'Tags', ['style'=>'margin-top:20px;'])}}
        <select class="form-control mult" name="tags[]" multiple="multiple">
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{ $tag->name}}</option>
            @endforeach
        </select>
      

        {{Form::label('featured_image', 'Upload Featured Image', ['style'=>'margin-top:20px;'])}}
        {{Form::file('featured_image')}}


    	{{ Form::label('body', 'Post Body', ['style'=>'margin-top:20px;'])}}
    	{{ Form::textarea('body',null, array('class' =>'form-control'))}}
    	

    	{{Form::submit('Create Post', array('class'=>'btn btn-success btn=lg btn-block', 'style' => 'margin-top:30px;'))}}

		{!! Form::close() !!}


	</div>
</div>


@endsection


<script type="text/javascript">
   $('.multi').select2();
</script>






