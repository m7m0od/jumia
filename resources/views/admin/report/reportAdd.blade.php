@extends('layouts/back')

@section('title')
add-report
@endsection

@section('content')
<form method="POST" action="{{url('/addReportAction')}}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" name="title" placeholder="type title">
            @error('title')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">description</label>
            <input type="text" class="form-control" name="description" placeholder="Enter your description">
            @error('description')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <select class="form-control" name="category_id" id="category" onchange="getItem()">
                <option>...</option>
                @foreach($category as $cat)
                <option value="{{$cat->id}}">{{$cat->title}}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Item</label>
            <select class="form-control" name="item_id" id="items">
                
            </select>
            @error('item_id')
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

@section('ajax')
<script>
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
    }
</script>
@endsection