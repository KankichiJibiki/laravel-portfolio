@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mx-auto w-50 mt-3 d-flex border justify-content-center p-3">
        {{-- img --}}
        <div class="w-50 mx-auto border me-2 p-2">
            <h4 class="mb-3">{{Auth::user()->username}}'s Profile</h4>
            <div class="mb-3">
            @if (Auth::user()->avatar == null)
                <img src="{{asset('storage/image/noimage-760x460.png')}}" alt="No-image" class="img img-responsive card-img-top">
            @else
                <img src="{{asset('storage/image/'. Auth::user()->avatar)}}" alt="No-image" class="img img-responsive card-img-top">
            @endif
            </div>
            <div class="mb-3">
                <a href="/users/{{Auth::user()->uuid}}/edit" class="btn btn-success">Edit Profile</a>
            </div>
        </div>
        {{-- other info --}}
        <div class="w-50 mx-auto border p-2">
            <div class="mb-3">First Name : {{Auth::user()->first_name}}</div>
            <div class="mb-3">Last Name : {{Auth::user()->last_name}}</div>
            <div class="mb-3">E-mail : {{Auth::user()->email}}</div>
        </div>
    </div>
@endsection
