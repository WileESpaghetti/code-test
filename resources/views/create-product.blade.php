@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
            <h1>Create Product</h1>
            <form method="post" enctype="multipart/form-data" action="/api/products">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Example product...">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="12.34" size="5">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Example products are really great..." rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Product Image (100x100)</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
