@extends('main')

@section('title', '| Edit Post')
{{Html::script('../js/tinymce.min.js')}}

{!!Html::style('../css/select2.min.css')!!}

<script type="text/javascript">
    tinymce.init({
        selector:'textarea',
        plugins: 'link code',
    });
</script>


@section('content')


<div class="row">
 	{!!Form::model($post, ['route' =>['posts.update', $post->id], 'method'=>'PATCH', 'files'=>true])!!}
	<div class="col-md-8">
		{{Form ::label('title', 'Title:')}}
		{{Form::text('title', null, ['class'=>'form-control input-lg'])}}
		<br>
		{{Form ::label('slug', 'Slug:', ['class' =>'form-spacing-top'])}}
		{{Form::text('slug', null, ['class'=>'form-control input-lg'])}}
		<br>  
		{{Form ::label('category_id', 'Category')}}
		{{Form::select('category_id', $categories, null, ['class'=>'form-control'])}}
		<br>
		 {{ Form::label('tags ', 'Tags')}}
		 {{Form::select('tags[]', $tags, null, ['class'=>'form-control', 'multiple' =>'multiple'])}}	   	 
        <br>

        {{ Form::label('featured_image', 'Update Image',['class'=>'form-spacing'])}}
		 {{Form::file('featured_image')}}	
		 <br>
		{{Form ::label('body', 'Body:')}}	
		{{Form::textarea('body', null, ['class'=>'form-control','required' =>''])}}
	</div>

	<div class="col-md-4">
		<div class="well">
			<dl class="dl-horizontal">
				<dt>Created at :</dt>
				<dd>{{date('j M, Y h:ia',strtotime($post->created_at))}}</dd>				
			</dl>

			<dl class="dl-horizontal">
				<dt>Last Updated :</dt>
				<dd>{{date('j M, Y h:ia',strtotime($post->updated_at))}}</dd>				
			</dl>

			<hr>	

			<div class="row">
				<div class="col-sm-6">	
						{!!Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block'))!!}
				</div>

				<div class="col-sm-6">
					{!!Form::open(['route'=>['posts.edit',$post->id]]) !!}

					{{Form::submit('Save Changes', ['class'=>'btn btn-success btn-block'])}}

					{!!Form::close() !!}


				</div>
			</div>

		</div>	
	</div>

	{!!Form::close()!!}

</div>	


@endsection

{!!Html::script('../js/select2.min.js')!!}

