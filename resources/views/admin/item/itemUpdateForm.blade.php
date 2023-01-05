@extends('layouts/back')

@section('title')
    updateItem
@endsection

@section('content')
<h1 class="mt-5">Form Data</h1>
@if($errors->any())
<div class="container">
    <ul>
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{url('/updateItemAction',$item->id)}}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" value="{{$item->title}}" name="title" placeholder="type title">
            @error('title')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">description</label>
            <input type="text" class="form-control" value="{{$item->description}}" name="description" placeholder="Enter your description">
            @error('description')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">price</label>
            <input type="number" class="form-control" value="{{$item->price}}" name="price" placeholder="Enter price">
            @error('description')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="form-control" name="category_id">
                @foreach($categories as $cat)
                    <option value="{{$cat->id}}" @if($cat->id == $item->category_id) selected @endif >{{$cat->title}}</option>
                @endforeach
            </select>   
            @error('category_id')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" name="pic" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
            @error('pic')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


@endsection