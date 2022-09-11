@extends('layouts.app')

@section('title', 'Home')
@section('jsName', 'main.js')

@section('content')
    @if (session('success_update'))
        <div class="alert alert-success">{{session('success_update')}}</div>
    @elseif (session('success_create'))
        <div class="alert alert-success">{{session('success_create')}}</div>
    @endif
    <div class="main_container container mx-auto">
        {{-- left and top words that user focuses on --}}
        <div class="left_top_container card p-3 mb-3 border-success">
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
        <div class="right_down_container container card p-3 mb-3"  style="background-color: #7d4e23;">
            <div class="header_slot d-flex">
                <div class="col-md-10">{{$words->links()}}</div>
                <div>
                    <a href="{{route('displaySlotResult')}}" class="btn btn-lg btn-success text-light border border-light border-3">
                        <span class="toolTip" data-descr="You slot 5 numbers and it applies to words id displaying">Slot Words</span>
                    </a>

                    <span class='tooltip' data-descr="each of a pair of flashing lights on a vehicle, warning that it is stationary or unexpectedly slowing down or reversing.">
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
                <div class="card_container mt-3">
                    @foreach ($words as $word)
                    {{-- @foreach (Auth::user()->words as $word) --}}
                        <div class="word-card card_child card p-3 text-light border border-light border-2 me-1 mb-1" style="background-color: #084d10;">
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
