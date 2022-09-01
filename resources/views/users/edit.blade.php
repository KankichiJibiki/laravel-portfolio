@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mx-auto w-50 mt-3 border justify-content-center p-3">
        @if (session('success_update'))
            <div class="alert alert-success">{{session('success_update')}}</div>
        @endif
        <form action="/users/{{Auth::user()->uuid}}" method="post" enctype="multipart/form-data" class="d-flex">
            @csrf
            @method('PATCH')
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
                    <input type="file" name="avatar" id="avatar" class="form-control">
                </div>
            </div>
            {{-- other info --}}
            <div class="w-50 mx-auto border p-2">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{Auth::user()->username}}">
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{Auth::user()->first_name}}" class="form-control">
                    </div>
                    <div class="col">
                        <label for="last_name" class="form-label">First Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{Auth::user()->last_name}}" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
