<!doctype html>

@include('partials._head')

@include('partials._nav')

 <!-- body -->
<body>
<!-- jumbotron -->
  <div class="container">
    @include('partials._mssg')

    @yield('content')
     
@include('partials._footer')

  </div> 
 
    <!-- Optional JavaScript -->
    @include('partials._javascript')
     </body>
</html>