@extends('layouts.main')

@section('body')
    <h1 class="mb-4 mt-5 text-center display-4"><b>ABOUT</b></h1>

    <div class="rounded col-md-8 mx-auto mt-5 pb-1" style="box-shadow: 0 2px 4px 0 rgba(0,0,0,.2);">
        <div class="d-flex m-3">
            <h5 class="lead mt-3">OUR PARTNERS</h5>
        </div>
        <div class="m-3 d-flex justify-content-between" style="background-color: white">
            <img src="/images/ta.jpg" class="img-fluid rounded py-3" alt="..." style="max-width: 48%; height: auto;">
            <img src="/images/pln.jpg" class="img-fluid rounded" alt="..." style="max-width: 48%; height: auto;">
        </div>
    </div>
@endsection
