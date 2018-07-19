@extends('backend.template')

@section('content')


<div class="col-12">
    <div class="row page-titles">
        <div class="col-md-6 align-self-center">
            <h3 class="text-themecolor">Banner
                <a data-toggle="tooltip" data-placement="bottom" title="<img src='{{ asset('images/desc/banner.jpg') }}'  />"  data-fancybox="gallery" href="{{ asset('images/desc/banner.jpg') }}" target="_blank" >
                    <i class="fa fa-info-circle"></i>
                </a>
            </h3>
        </div>
         <div class="col-md-6 align-self-center text-right d-none d-md-block">
            <a href="#">
                <button type="button" class="btn btn-warning"><i class="fa fa-plus-circle"></i> เรียงลำดับ</button>
            </a>
            <a href="#">
                <button type="button" class="btn btn-info"><i class="fa fa-plus-circle"></i> เพิ่ม</button>
            </a>
        </div>
    </div>
    <div class="card">
        <div class="row m-t-5 m-l-15 text-right">
           {{--  {!! Form::open(['method' => 'GET', 'route' => ['location.index'],'class' => 'form-material text-left col-4 p-r-40']) !!}
                {{ Form::text('s',isset($s) ? $s : '',['placeholder' => 'ค้นหา','class' => 'form-control col-10' ]) }}
                {{ Form::button('<i class="fa fa-search"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-inverse waves-effect waves-light'] )  }}
            {!! Form::close() !!} --}}
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Img</th>
                            <th>Updated_at</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>sss</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
