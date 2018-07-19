<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="{{ asset('js/jquery.cropit.js') }}"></script>
  {{--
  <style>
    .cropit-preview {
      background-color: #f8f8f8;
      background-size: cover;
      border: 1px solid #ccc;
      border-radius: 3px;
      margin-top: 7px;
      width: 400px;
      height: 250px;
    }

    .cropit-preview-image-container {
      cursor: move;
    }

    .image-size-label {
      margin-top: 10px;
    }

    input,
    .export {
      display: block;
    }

    button {
      margin-top: 10px;
    }

    .cropit-preview-background {
      opacity: .2;
    }

    /*
       * If the slider or anything else is covered by the background image,
       * use relative or absolute position on it
       */

    input.cropit-image-zoom-input {
      position: relative;
    }

    /* Limit the background image by adding overflow: hidden */

    #image-cropper {
      overflow: hidden;
    }
  </style> --}} {{--
  <script>
    $(function() {
      $('#image-cropper').cropit({
        imageBackground: true
      });
      $('.image-editor').cropit({
        exportZoom: 2.0,
        imageBackground: true,
        imageBackgroundBorderWidth: 20,
      });
      $('.rotate-cw').click(function() {
        $('.image-editor').cropit('rotateCW');
      });
      $('.rotate-ccw').click(function() {
        $('.image-editor').cropit('rotateCCW');
      });
      $('.export').click(function() {
        var imageData = $('.image-editor').cropit('export');
        window.open(imageData);
      });
    });
  </script> --}} {{--
  <script>
    $(document).ready(function() {
      $("#btnSend").click(function(e) {
        var result = window.confirm('Are you sure?');
        if (result == false) {
          e.preventDefault();
        } else {
          document.getElementById("form1").submit();
        };
      });
    });
  </script> --}}
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fb_name }} <span class="caret"></span>
                                </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  @if (session('success'))
  <div class="alert alert-success">
    <p>
      <h4>{{session('success')}}</h4></p>
  </div>
  @endif
  @if (session('warning'))
  <div class="alert alert-warning">
    <p>
      <h4>{{session('warning')}}</h4></p>
  </div>
  @endif {{--
  @if (count($images) == 0) --}}
  <form action="/upload/image" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <span>Upload Image </span>
    <div class="image-editor">
      <input type="file" name="image"> {{--
      <div class="cropit-preview"></div> --}} {{--
      <div class="image-size-label">
        Resize image
      </div>
      <input type="range" class="cropit-image-zoom-input">
      <button type="button" class="rotate-ccw">Rotate counterclockwise</button>
      <button type="button" class="rotate-cw">Rotate clockwise</button>
    </div> --}}
    <button type="submit" class="btn btn-success pull-right" id="btnSend">Upload</button>
  </form>
  {{--
  @endif --}}

  @if (count($images) !== 0)
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <!-- Menu -->
    <ol class="carousel-indicators">
      @for ($i=0; $i
      < count($images); $i++) @if ($i == 0 )
      <li data-target="#carousel" data-slide-to="{{$i}}" class="active"></li>
      @else
      <li data-target="#carousel" data-slide-to="{{$i}}"></li>
      @endif
      @endfor
    </ol>
    <!-- Items -->
    <div>
      <form action="/delete/image" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @for ($i=0; $i
        < count($images); $i++) {{-- @if ($i == 0 ) --}} {{--
        <div class="item active"> --}}
          <img src="{{url('image/'. $images[$i]->image )}}">
          <input type="hidden" name="image" value="{{$images[$i]->image}}"> {{-- </div> --}} {{--
        @else --}} {{--
        <div class="item"> --}} {{-- <img src="{{url('image/'.$images[$i]->fileName )}}" alt="Slide {{$i}}" /> --}} {{-- </div> --}} {{--
        @endif --}}
        <button type="submit" id="deleteImage">Delete</button>
        @endfor
    </div>

    </form>
    {{-- <a href="#carousel" class="left carousel-control" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
    <a href="#carousel" class="right carousel-control" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a> --}}
  </div>
  @endif
</body>

</html>
