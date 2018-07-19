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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="<?=asset('js/canvas-to-blob.min.js')?>"></script>
    <script src="<?=asset('js/exif.js')?>"></script>
    <script src="<?=asset('js/cropper.min.js')?>"></script>
    <script src="https://unpkg.com/merge-images"></script>
    <link rel="stylesheet" href="<?=asset('css/cropper.min.css')?>"></link>

    <script>
    // window.addEventListener('DOMContentLoaded', function () {
    //   var image = document.getElementById('image');
    //   var cropBoxData;
    //   var canvasData;
    //   var cropper;
    //   $('#modal').on('shown.bs.modal', function () {
    //     cropper = new Cropper(image, {
    //       autoCropArea: 0.5,
    //       ready: function () {
    //         //Should set crop box data first here
    //         cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
    //       }
    //     });
    //   }).on('hidden.bs.modal', function () {
    //     cropBoxData = cropper.getCropBoxData();
    //     canvasData = cropper.getCanvasData();
    //     cropper.destroy();
    //   });
    // });
    window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('avatar');
    var image = document.getElementById('image');
    var input = document.getElementById('input');
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#modal');
    var cropper;
    $('[data-toggle="tooltip"]').tooltip();
    input.addEventListener('change', function (e) {
      var files = e.target.files;
      var done = function (url) {
        input.value = '';
        image.src = url;
        $alert.hide();
        $modal.modal('show');
      };
      var reader;
      var file;
      var url;
      if (files && files.length > 0) {
        file = files[0];
        if (URL) {
          done(URL.createObjectURL(file));
        } else if (FileReader) {
          reader = new FileReader();
          reader.onload = function (e) {
            done(reader.result);
          };
          reader.readAsDataURL(file);
        }
      }
    });
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
      });
    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });
    document.getElementById('crop').addEventListener('click', function () {
      var initialAvatarURL;
      var canvas;
      $modal.modal('hide');
      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          width: 160,
          height: 160,
        });
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        mergeImages(['/body.png', '/eyes.png', '/mouth.png'])
        .then(b64 => document.querySelector('img').src = b64);
        // canvas.toBlob(function (blob) {
        //   var formData = new FormData();
        //   formData.append('avatar', blob);
        //   $.ajax('/', {
        //     method: 'POST',
        //     data: formData,
        //     processData: false,
        //     contentType: false,
        //     xhr: function () {
        //       var xhr = new XMLHttpRequest();
        //       xhr.upload.onprogress = function (e) {
        //         var percent = '0';
        //         var percentage = '0%';
        //         if (e.lengthComputable) {
        //           percent = Math.round((e.loaded / e.total) * 100);
        //           percentage = percent + '%';
        //           $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
        //         }
        //       };
        //       return xhr;
        //     },
        //     success: function () {
        //       $alert.show().addClass('alert-success').text('Upload success');
        //     },
        //     error: function () {
        //       avatar.src = initialAvatarURL;
        //       $alert.show().addClass('alert-warning').text('Upload error');
        //     },
        //     complete: function () {
        //       $progress.hide();
        //     },
        //   });
        // });
      }
    });
  });
    </script>
    <style>
    .container {
    max-width: 640px;
    margin: 20px auto;
  }
  img {
    max-width: 100%;
  }
  /* .cover {
    padding: 10px;
    padding-right: 100px;

    background: url(images/desc/frame.png) no-repeat; */
}
    </style>
    <script>
          $(function() {
        });
    </script>
    <script>
    $(document).ready(function () {
            $("#btnSend").click(function (e) {
                var result = window.confirm('Are you sure?');
                if (result == false) {
                    e.preventDefault();
                }else{
                    document.getElementById("form1").submit();
                };
            });
        });
    </script>
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
          <p><h4>{{session('success')}}</h4></p>
        </div>
      @endif
      @if (session('warning'))
        <div class="alert alert-warning">
          <p><h4>{{session('warning')}}</h4></p>
        </div>
      @endif
  <div class="container">
    {{-- <h1>Cropper in a Bootstrap modal</h1> --}}

    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-target="#modal" data-toggle="modal">
      Launch the demo
    </button> --}}
        {{-- @php
        $dest = imagecreatefrompng('images/desc/frame.png');
        $src = imagecreatefromjpeg('images/desc/banner.jpg');

        imagealphablending($dest, false);
        imagesavealpha($dest, true);

        imagecopymerge($dest, $src, 10, 9, 0, 0, 181, 180, 100); //have to play with these numbers for it to work for you, etc.

        header('Content-Type: image/png');
        imagepng($dest);

        imagedestroy($dest);
        imagedestroy($src);

        @endphp --}}


        {{-- <div class="cover">
           <img src="images/desc/banner.jpg" alt="Moving mountains by Pneuma"/>
        </div> --}}
    <div class="container">
      <h1>Upload cropped image to server</h1>
      <label class="label" data-toggle="tooltip" title="Change your avatar">
        <img  id="avatar" src="{{url('images/desc/frame.png')}}" alt="avatar">
        <input type="file" class="sr-only" id="input" name="image" accept="image/*">
      </label>
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
      </div>
      <div class="alert" role="alert"></div>
      <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">Crop the image</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="img-container">
                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>

</script>
<img id="img1" src="{{url('images/desc/frame.jpg')}}">
<img id="img2" src="{{url('images/desc/banner.jpg')}}">
<canvas id="canvas"></canvas>

<script type="text/javascript">
var c=document.getElementById("myCanvas");
var ctx=c.getContext("2d");
var imageObj1 = new Image();
var imageObj2 = new Image();
imageObj1.src = 'images/desc/frame.jpg'
imageObj1.onload = function() {
   ctx.drawImage(imageObj1, 0, 0, 328, 526);
   imageObj2.src = 'images/desc/banner.jpg';
   imageObj2.onload = function() {
      ctx.drawImage(imageObj2, 15, 85, 300, 300);
      var img = c.toDataURL("image/png");
      document.write('<img src="' + img + '" width="328" height="526"/>');
   }
};
</script>
</body>
</html>
