@extends('layouts.layout')

@section('title')
    Register
@endsection

@section('content')

<div class="alignItem">
    <form method="POST" action="{{url('/signAction')}}">
        @csrf
        <a href="{{url('/index')}}"><img class=" mb-3" src="{{asset('uploads/l.png')}}"></a>
        <div class="form-group forPosition">
            <input type="text" name="name" value="{{old('name')}}" placeholder="Full name" class="form-control inputFocus">
            <ion-icon name="person-circle-outline"></ion-icon>
            @error('name')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group forPosition">
            <input type="email" name="email" placeholder="type your email" class="form-control inputFocus">
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
        <div class="form-group forPosition">
            <input type="password" name="password_confirmation" placeholder="confirm your password" class="form-control inputFocus inputForShow">
            <ion-icon name="eye-outline"></ion-icon>
            @error('password_confirmation')
            <div class="alert alert-danger mt-2">{{$message}}</div>
            @enderror
        </div>
            <button type="submit" class="btnn btn">SignUp</button>
            <div class="d-flex justify-content-between">
                <a class="linkk" href="{{url('/login')}}">Already Have an Account ?</a>
            </div>
    </form>
</div>

@endsection