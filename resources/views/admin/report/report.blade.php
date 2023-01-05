@extends('layouts/back')

@section('title')
Reports
@endsection

@section('content')
<div class="row">
  @foreach($reports as $report)
  <div class="col-md-6 card">
    <div class="card-body d-flex justify-content-between">
      <div class="first">
        <div  class="d-flex justify-content-between">
          <h5>{{$report->title}}</h5>
          <h5 class="mr-3">{{$report->user->name}}</h5>
        </div>
        <div  class="d-flex justify-content-between">
          <h5>{{$report->item->title}}</h5>
          <h5 class="mr-3">{{$report->category->title}}</h5>
        </div>
        <div class="mt-4">
          <p>{{$report->description}}</p>
          <a href="{{url('/updateReport/'.$report->id)}}" class="card-link">update</a>
          <a href="{{url('/deleteReport/'.$report->id)}}" class="card-link">delete</a>
        </div>
      </div>
      <div class="second">
          <img src="{{asset($report->item->pic)}}" class="card-img-top" alt="...">
      </div>
    </div>
  </div>
  @endforeach
</div>
<a href="{{url('/addReport')}}" class="btn btn-info card-link">add</a>
@endsection