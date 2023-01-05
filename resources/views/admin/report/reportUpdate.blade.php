@extends('layouts/back')

@section('title')
update-report
@endsection

@section('content')
<form method="POST" action="{{url('/updateReportAction',$report->id)}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" value="{{$report->title}}" name="title" placeholder="type title">
            @error('title')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">description</label>
            <input type="text" class="form-control" value="{{$report->description}}" name="description" placeholder="Enter your description">
            @error('description')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <!--
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="form-control" name="category_id" id="category" onchange="getItem()">
                @foreach($category as $cat)
                <option value="{{$cat->id}}" @if($cat->id == $report->category_id) selected @endif>{{$cat->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Item</label>
            <select class="form-control" name="item_id" id="items">
                @foreach($items as $item)
                <option value="{{$item->id}}" @if($item->id == $report->item_id) selected @endif>{{$item->title}}</option>
                @endforeach
            </select>
        </div>
    </div>-->
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection

@section('ajax')
<script>
    /*
    function getItem() {
        let category = $("#category").find(":selected").val();
        $.ajax({
            "type": "get",
            "url": `itemAjax/${category}`, 
            "success": function(data) {
                $("#items").html(data);
            },
            "error": function(data) {

            }
        });
    }*/
</script>
@endsection