@extends('layouts.app')

@section('title', 'Home')
@section('jsName', 'main.js')

@section('content')
    @if (session('success_update'))
        <div class="alert alert-success">{{session('success_update')}}</div>
    @elseif (session('success_create'))
        <div class="alert alert-success">{{session('success_create')}}</div>
    @endif
    <div class="main_container container">
        <div class="col-lg-12 col-11 d-flex flex-wrap justify-content-around align-items-start">
            {{-- left and top words that user focuses on --}}
            <div class="left_top_container col-lg-4 col-12 p-3 mb-3 border-success">
                <h4 class="text-center">Slot History</h4>
                <p class="mb-3"><span class="text-danger">Note: </span>Store histories up to 3 content and 1 day</p>
                <div class="cache_container">

                    @if (Cache::has('oldest'))
                        <a href="{{route('showCache', 'oldest')}}" class="cache_anchor container card mb-3">
                        <div class="mb-2">{{cache()->get('oldest')['time']->diffForHumans()}}</div>
                        @foreach (Cache::get('oldest')['wordSet'] as $wordhistory)
                            <div class="text-muted text-center p-1">{{$wordhistory->word}}</div>
                        @endforeach
                        </a>
                    @endif
                    @if (cache()->has('second'))
                        <a href="{{route('showCache', 'second')}}" class="cache_anchor container card mb-3">
                        <div class="mb-2">{{cache()->get('second')['time']->diffForHumans()}}</div>
                        @foreach (Cache::get('second')['wordSet'] as $wordhistory)
                            <div class="text-muted text-center p-1">{{$wordhistory->word}}</div>
                        @endforeach
                        </a>
                    @endif
                    @if (cache()->has('latest'))
                        <a href="{{route('showCache', 'latest')}}" class="cache_anchor container card mb-3">
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
            </div>
            {{-- right and down overview word set --}}
            <div class="right_down_container col-lg-7 col-12 p-3 mb-3" style="background-color: #7d4e23;">
                <div class="header_slot d-flex flex-wrap justify-content-center">
                    <div class="col-12 d-flex flex-wrap justify-content-between">
                        <a href="{{route('displaySlotResult')}}" class="btn btn-success text-light border border-light border-3 col-md-3 col-5 mb-2">
                            <span class="toolTip" data-descr="You slot 5 numbers and it applies to words id displaying">Slot</span>
                        </a>

                        {{-- <span class='tooltip' data-descr="each of a pair of flashing lights on a vehicle, warning that it is stationary or unexpectedly slowing down or reversing."> --}}
                        <form action="{{ route('search_result') }}" method="post" class="col-12 col-md-7">
                            @csrf

                            <div class="input-group">
                                {{-- <div class="d-flex me-1 mt-2">
                                    <div class="form-check form-check-inline">
                                        <label for="1" class="form-label text-light">Word</label>
                                        <input type="radio" name="search_type" id="1" class="form-check-input" value="1">
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label for="2" class="form-label text-light">Type</label>
                                        <input type="radio" name="search_type" id="2" class="form-check-input" value="2">
                                    </div>
                                </div> --}}

                                <input type="text" name="q" id="q" class="form-control" placeholder="Search in...">
                                <button type="submit" class="btn btn-dark input-group-btn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
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
                    <div class="card_container mt-3 d-flex flex-wrap justify-content-center align-items-around">
                        @foreach ($words as $word)
                        {{-- @foreach (Auth::user()->words as $word) --}}
                            <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-5 col-6">
                                        <a href="/words/{{$word->uuid}}/edit" class="btn btn-warning btn-sm d-grid">Edit</a>
                                    </div>
                                    <div class="col-md-5 col-6">
                                        <form action="/words/{{$word->uuid}}" method="post" class="d-grid">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger" onsubmit="return confirm_delete()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="fs-5 mb-3">Word: <span class="fw-bold fs-4">{{$word->word}}</span></div>
                                <div class="fs-5 mb-3">Definition: <span class="fw-bold fs-4">{{$word->definition}}</span></div>
                                <div class="fs-5 mb-3">Type: <span class="fw-bold fs-4">
                                    {{$word->type->name}}    
                                </span></div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex flex-wrap aligh-items-center justify-content-center">
                        <div class="">
                            {{$words->links()}}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
