@extends('layouts.layout')

@section('title')
login
@endsection

@section('content')

<div class="alignItem">
  <form method="POST" action="{{url('/loginAction')}}">
    @csrf
    <a href="{{url('/index')}}"><img class=" mb-3" src="{{asset('uploads/l.png')}}"></a>
    <div class="form-group forPosition">
      <input type="email" name="email" value="{{old('email')}}" placeholder="type your email" class="form-control inputFocus">
      <ion-icon name="mail-outline"></ion-icon>
      @error('email')
      <div class="alert alert-danger mt-2">{{$message}}</div>
      @enderror
    </div>
    <div class="form-group forPosition">
      <input type="password" name="password" placeholder="type your password" class="form-control inputFocus inputForShow">
      <ion-icon name="eye-outline"></ion-icon>
      @error('password')
      <div class="alert alert-danger mt-2">{{$message}}</div>
      @enderror
    </div>
    <button type="submit" class="btnn btn">login</button>
    <div class="d-flex justify-content-between">
     
      <a href="{{url('/signup')}}" class="linkk ">Don't have account ?</a>
      <a class="linkk" href="{{url('/forget')}}">Forget Password ?</a>
    </div>
   
  </form>
  <a href="{{url('/redirect/facebook')}}" type="submit" class="mt-3 btnSocial btn"><ion-icon class="mrForSocial" name="logo-facebook"></ion-icon> login with facebook</a><div class="clr"></div>
  @if(Session::has('verify'))
    <div class="mt-2">
        <p class="text-center m-auto alert alert-info">{{ Session('verify') }}</p>
    </div>
    @elseif(Session::has('message'))
    <div class="mt-2">
        <p class="text-center m-auto alert alert-info">{{ Session('message') }}</p>
    </div>
    @endif
</div>

@endsection