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
  <link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{--
  <script src="{{ asset('js/jquery.cropit.js') }}"></script> --}}
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
  <div class="container-fluid">
    @if (count($images) !== 0)
    <div id="carousel" class="carousel slide" data-ride="carousel">
      <!-- Modal for edit -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Vote Picture</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('') }}" method="POST" id="form-vote">
                {{ csrf_field() }}
                <div class="form-group">
                  {{-- <label for="recipient-name" class="col-form-label">Sub-Task Name:</label> --}} {{-- <input type="hidden" name="id" id="subtask-id"> --}}
                  <input type="text" class="form-control" name="name" id="image-name" readonly>
                  <input type="hidden" name="image-id" id="image-id">
                </div>
                <div class="form-group">
                  <img src="" id="show-img" width="400px" height="300px">
                  <label for="message-text" class="col-form-label">Description:</label>
                  <textarea class="form-control" name="desc" id="desc-text" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {{-- @if ($diff>24)
                  <button type="submit" class="btn btn-primary" id="vote-photo" >VOTE</button>
              @else
                  <button type="submit" class="btn btn-primary" id="vote-photo" disabled>VOTE</button>
              @endif --}}
              <button type="submit" class="btn btn-primary" id="vote-photo" >VOTE</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <!-- Items -->
        @for ($i=0; $i< count($images); $i++)
            <div class="card" style="width: 18rem;">
                <img src="{{url('image/'. $images[$i]->image )}}" class="card-img-top" data-target="#exampleModal">
                <div class="card-body">
                <input type="hidden" name="image" value="{{$images[$i]->image}}">
                <input type="hidden" name="data-id" value="{{$images[$i]->id}}">
                <input type="hidden" name="data-name" value="{{$images[$i]->fb_name}}">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-name="{{ Auth::user()->fb_name }}" data-id="{{ $images[$i]->id}}" data-desc="{{$images[$i]->description}}" data-image="{{url('image/'. $images[$i]->image )}}" data-target="#exampleModal">
                        Vote
                </button>
            @if ($images[$i]->vote == 0 )
                <button type="button">0</button>
                </div>
            @else
            <button type="button">{{$images[$i]->vote}}</button>
            @endif
            </div>
          @endfor
      </div>
    </div>
  </div>
  @endif

  <script type="text/javascript">
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var name = button.data('name')
      var id = button.data('id')
      var desc = button.data('desc')
      var img = button.data('image')
      // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Vote photo')
      modal.find('#image-id').val(id)
      modal.find('#image-name').val(name)
      modal.find('#desc-text').val(desc)
      $("#show-img").attr('src', img);

      //get data form modal
      $('#form-vote').submit(function(e) {
        e.preventDefault();
        var data = id;
        vote(data,name);
      });

      //vote funtion
      function vote(data,name) {
          // console.log(data);
          // console.log(name);
        swal({
            title: "ยืนยันการโหวต ?",
            text: "โหวตแล้วนะครับ",
            icon: "warning",
            buttons: ['ยกเลิก', 'ตกลง'],
            dangerMode: true
          }).then((willrestore) => {
              // console.log(willrestore);
          if(willrestore){
              $.post("/vote", {
                  id: data,
                  _token: "{{ csrf_token() }}"
              }).then((res) => {
                  if (res) {
                      swal({
                          text: "ท่านได้โหวตให้กับ " + name + " แล้วนะครับ",
                          icon: "success",
                          button: 'ตกลง'
                      }).then((ok) =>{
                          window.location.href = "/showAll";
                      })
                  } else {
                      swal("ไม่มีข้อมูลอยู่ในระบบ !", {
                          icon: "warning",
                          button: 'ตกลง'
                      }).then((ok) =>{
                          window.location.href = "/showAll";
                      })
                  }
                  // window.location.href = "/showAll";
              })
          }
          })
      }
    })
  </script>
</body>

</html>
