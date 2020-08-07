@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <user-info></user-info>

            <user-product-list></user-product-list>

            <product-list></product-list>
        </div>
    </div>
</div>
@endsection
