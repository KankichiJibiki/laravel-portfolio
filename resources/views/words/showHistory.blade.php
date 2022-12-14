@extends('layouts.app')

@section('title', 'History')

@section('content')
    <div class="container mx-auto">
        {{-- Slot --}}
        <div class="w-100 card p-3" style="background-color: #7d4e23;">
            <div class="justify-content-between align-items-start d-flex">
                <a href="{{route('index')}}" class="btn btn-outline-light col-2">Back</a>
                <div class="my-3 text-light fs-5">{{cache()->get($cache)['time']->diffForHumans()}}</div>
            </div>
            {{-- Display Word set --}}
            <div class="card_container my-2 d-flex flex-wrap justify-content-center align-items-around">
                @foreach (cache()->get($cache)['wordSet'] as $word)
                    <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                        <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br>{{$word->word}}</div>
                        <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br>{{$word->definition}}</div>
                        <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br>{{$word->type->name}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
