@extends('layouts.app')
@section('page_style')
@endsection
@section('content')
<div class="container-fluid">
    <div class="row justify-content-between main-tab mt-lg-5">
        <div class="col-lg-3 col-md-4">
            <ol class="list-group list mb-3">
                <li class="list-group-item title-item d-flex justify-content-between align-items-start pt-lg-3 pb-lg-3">
                    <div class="ms-2 me-auto align-self-center">
                        <div class="fw-bold text-uppercase">Files</div>
                    </div>
                    <form class="align-self-center" style="height: 26px;" action="{{route('upload.file')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="btn-wrapper">
                            <input type="file" name="document" id="" required accept="application/pdf" />

                            <input class="button-submit" type="submit" value="Upload">
                        </div>
                    </form>
                </li>

            </ol>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($files as $file )
                <button class="nav-link text-start p-lg-4 pdf_link" id="{{$file->id}}" data-bs-toggle="pill" data-bs-target="#v-pills-one" data-id="{{$file->id}}" @if($file->user_id==auth()->user()->id)
                    data-url="{{$file->path}}"
                    @endif
                    data-title="{{$file->filename}}" type="button" role="tab" aria-controls="v-pills-one" aria-selected="true">
                    <h5>{{$file->filename}}</h5>
                    <p class="mb-0">@if($file->user_id==auth()->user()->id)
                        Me
                        @else
                        Other
                        @endif,
                        {{$file->user->name}}
                    </p>
                </button>
                @endforeach
            </div>
        </div>
        @include('home.canvas')
    </div>
</div>

@endsection

@section('page_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
<script src="{{ asset('/assets/js/custom/homepage.js')}}"></script>
@endsection