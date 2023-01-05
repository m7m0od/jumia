@extends('layouts.layout')

@section('title')
    Reset Password
@endsection

@section('content')

<div class="alignItem">
<form method="POST" action="{{route('password.update')}}">
    @csrf
    <a href="{{url('/index')}}"><img class=" mb-3" src="{{asset('uploads/l.png')}}"></a>
    
    <div class="form-group forPosition">
        <input type="hidden" name="email" value="{{$_GET['email']}}">
      <input type="password" name="password" placeholder="new password" class="form-control inputFocus inputForShow">
      <ion-icon name="eye-outline"></ion-icon>
      @error('password')
      <div class="alert alert-danger mt-2">{{$message}}</div>
      @enderror
    </div>
    <div class="form-group forPosition">
      <input type="password" name="password_confirmation" placeholder="confirm your password" class="form-control inputFocus inputForShow">
      <ion-icon name="eye-outline"></ion-icon>
      @error('password')
      <div class="alert alert-danger mt-2">{{$message}}</div>
      @enderror
    </div>
    <button type="submit" class="btnn btn">Update</button>
  </form>

@endsection