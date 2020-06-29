@extends('main')
@section('title','| homepage')
@section('content')

    <div class="row">
     <div class="col-md-12">
        <div class="jumbotron">
            <h1><strong>This is a Test Blog</strong></h1>   
            <p class="lead "> This test site was built using laravel</p>
            <!-- <p><a href="" class="btn btn-primary btn-lg" role="button">Popular post</a></p> -->
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">

        @foreach($posts as $post)

         <div class="post">
          <h3>{{$post->title}}</h3>
          <p>{{substr(strip_tags($post->body), 0, 300)}}{{strlen(strip_tags($post->body))> 300 ? "...": " "}}</p>
          <a href="{{url('blog/'.$post->slug)}}" class="btn btn-primary">Read more</a>
        </div>
        <hr>

        @endforeach

    </div>
        

      <div class="col-md-3 col-md-offset-1" style="red">
        <h2>Side Bar</h2>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt u t labore et dolore magna aliqua. Ut enim ad minim veniam,
        <hr>
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        <hr>
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        
      </div>
    </div>

  @endsection