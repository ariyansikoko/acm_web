@extends('layouts.main')

@section('body')
    <h1 class="mb-4">Welcome!</h1>
    <div class="mx-auto mb-5">
        <div class="col-md-auto justify-content-center">
            <h2 class="text-center mb-4">PT Acero Cetha Metalindo</h2>
            <div class="card-group m-3">
                <div class="card m-3">
                    <img src="/images/a.jpg" alt="" class="float-start rounded">
                </div>
                <div class="card m-3">
                    <img src="/images/b.jpg" alt="" class="rounded">
                </div>
                <div class="card m-3">
                    <img src="/images/c.jpg" alt="" class="rounded">
                </div>
                <div class="card m-3">
                    <img src="/images/d.jpg" alt="" class="float-end rounded">
                </div>
            </div>
            <div class="card-group">
                <div class="card m-3">
                    <img src="/images/g.jpg" class="card-img" alt="..." style="width:100%">
                </div>
                <div class="card m-3">
                    <img src="/images/e.jpg" class="card-img" alt="..." style="width:100%">
                </div>
            </div>
        </div>
    </div>
@endsection
