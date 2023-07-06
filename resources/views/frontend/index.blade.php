@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    index
                </div>
                <div class="card-body">
                    {{config('app.locale')}}
                    <i class="fa fa-telegram" aria-hidden="true"></i>
                    <i class="fa fa-superpowers" aria-hidden="true"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </div>
        </div>

    </div>
@endsection
