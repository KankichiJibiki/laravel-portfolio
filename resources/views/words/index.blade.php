@extends('layouts.app')

@section('title', 'Home')
@section('jsName', 'main.js')

@section('content')
    @if (session('success_update'))
        <div class="alert alert-success">{{session('success_update')}}</div>
    @elseif (session('success_create'))
        <div class="alert alert-success">{{session('success_create')}}</div>
    @endif
    <div class="container d-flex mx-auto">
        {{-- left words that user focuses on --}}
        <div class="w-25 card p-3 me-2 border-success">
            <h4 class="text-center">Slot History</h4>
            <p class="mb-3"><span class="text-danger">Note: </span>Store histories up to 3 content and 1 day</p>
            @if (Cache::has('oldest'))
                <a href="{{route('showCache', 'oldest')}}" class="container card mb-3">
                <div class="mb-2">{{cache()->get('oldest')['time']->diffForHumans()}}</div>
                @foreach (Cache::get('oldest')['wordSet'] as $wordhistory)
                    <div class="text-muted text-center p-1">{{$wordhistory->word}}</div>
                @endforeach
                </a>
            @endif
            @if (cache()->has('second'))
                <a href="{{route('showCache', 'second')}}" class="container card mb-3">
                <div class="mb-2">{{cache()->get('second')['time']->diffForHumans()}}</div>
                @foreach (Cache::get('second')['wordSet'] as $wordhistory)
                    <div class="text-muted text-center p-1">{{$wordhistory->word}}</div>
                @endforeach
                </a>
            @endif
            @if (cache()->has('latest'))
                <a href="{{route('showCache', 'latest')}}" class="container card mb-3">
                <div class="mb-2">{{cache()->get('latest')['time']->diffForHumans()}}</div>
                @foreach (Cache::get('latest')['wordSet'] as $wordhistory)
                    <div class="text-muted text-center p-1">{{$wordhistory->word}}</div>
                @endforeach
                </a>
            @endif
            @if(!cache()->has('oldest'))
                <div class="text-muted text-center my-5 fs-3">No History</div>
            @endif
        </div>
        {{-- right overview word set --}}
        <div class="w-75 card p-3"  style="background-color: #7d4e23;">
            <div class="d-flex justify-content-center">
                <div class="col-md-10">{{$words->links()}}</div>
                <div>
                    <a href="{{route('displaySlotResult')}}" class="btn btn-lg btn-success text-light border border-light border-3">
                        <i class="fa-light fa-slot-machine">Slot words</i>
                    </a>
                </div>
            </div>
            @if ($words->isEmpty())
            {{-- @if (Auth::user()->words->isEmpty()) --}}
                <div class="text-center mt-3">
                    <div class="text-light fs-5">You haven't registered any words yet!</div>

                    {{-- modal create words --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#createword">
                        Register Words
                    </button>


                    {{-- end modal --}}
                </div>
            @else
                <div class="d-flex flex-wrap mt-3">
                    @foreach ($words as $word)
                    {{-- @foreach (Auth::user()->words as $word) --}}
                        <div class="card p-3 text-light border border-light border-2 me-1 mb-1" style="background-color: #084d10; width: 24%;">
                            <div class="row mt-3">
                                <div class="col">
                                    <a href="/words/{{$word->uuid}}/edit" class="btn btn-warning btn-sm d-grid">Edit</a>
                                </div>
                                <div class="col">
                                    <form action="/words/{{$word->uuid}}" method="post" class="d-grid">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger" onsubmit="return confirm_delete()">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="fs-5 mb-3">Word: <span class="fw-bold fs-4">{{$word->word}}</span></div>
                            <div class="fs-5 mb-3">Definition: <span class="fw-bold fs-4">{{$word->definition}}</span></div>
                            <div class="fs-5 mb-3">Type: <span class="fw-bold fs-4">{{$word->type == null ? "null" : $word->type}}</span></div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
