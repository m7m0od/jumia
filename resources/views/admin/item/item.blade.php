@extends('layouts/back')

@section('title')
Items
@endsection

@section('content')
<div class="row">
  @foreach($item as $H)
  <div class="col-md-4">
    <div class="card forPositionCard">
      <img src="{{asset($H->pic)}}" class="card-img-top" alt="...">
      <div class="card-body">
        <div class="d-flex justify-content-between"><h5 class="card-title">{{$H->title}}</h5></div>
        <h5 class="card-title">{{$H->category->title}}</h5>
        <h6 class="card-text">{{$H->description}}</h6>
      </div>
      <div class="card-body">
        <a href="{{url('/updateItem/'.$H->id)}}" class="card-link">update</a>
        <a href="{{url('/deleteItem/'.$H->id)}}" class="card-link">delete</a>
      </div>
      <div class="forPositionPrice">${{$H->price}}</div>
    </div>
  </div>
  @endforeach
</div>
<a href="{{url('/addItem')}}" class="btn btn-info card-link">add</a>
@endsection