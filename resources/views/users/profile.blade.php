@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mx-auto w-50 mt-3 d-flex border justify-content-center p-3" style="background-color: #d7f6fa;">
        {{-- img --}}
        <div class="w-50 mx-auto border me-2 p-2 bg-light">
            <h4 class="my-3">{{Auth::user()->username}}'s Profile</h4>
            <div class="mb-3">
            @if (Auth::user()->avatar == null)
                <img src="{{asset('storage/image/noimage-760x460.png')}}" alt="No-image" class="img img-responsive card-img-top">
            @else
                <img src="{{asset('storage/image/'. Auth::user()->avatar)}}" alt="No-image" class="img img-responsive card-img-top">
            @endif
            </div>
        </div>
        {{-- other info --}}
        <div class="w-50 mx-auto border p-2 bg-light">
            <ul class="list-group">
                <li class="mb-3 list-group-item fs-4">Username : {{Auth::user()->username}}</li>
                <li class="mb-3 list-group-item fs-4">First Name : {{Auth::user()->first_name}}</li>
                <li class="mb-3 list-group-item fs-4">Last Name : {{Auth::user()->last_name}}</li>
                <li class="mb-3 list-group-item fs-4">E-mail : {{Auth::user()->email}}</li>
            </ul>
            <div class="mb-3">
                <a href="/users/{{Auth::user()->uuid}}/edit" class="btn btn-success d-grid">Edit Profile</a>
            </div>
        </div>
    </div>
@endsection
