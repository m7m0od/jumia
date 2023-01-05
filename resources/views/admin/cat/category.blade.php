@extends('layouts/back')

@section('title')
Category
@endsection

@section('content')
<div class="row">
  @foreach($cats as $cat)
  <div class="col-md-4">
    <div class="card">
      <a href="{{url('/items/'.$cat->id)}}"><img src="{{asset($cat->pic)}}" class="card-img-top" alt="..."></a>
      <div class="card-body">
        <h5 class="card-title">{{$cat->title}}</h5>
        <h6 class="card-text">{{$cat->description}}</h6>
      </div>
      <div class="card-body">
        <a href="{{url('/updateCat/'.$cat->id)}}" class="card-link">update</a>
        <a href="{{url('/deleteCat/'.$cat->id)}}" class="card-link">delete</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
<a href="{{url('/addCat')}}" class="btn btn-info card-link">add</a>
@endsection