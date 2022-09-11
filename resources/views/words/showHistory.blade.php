@extends('layouts.app')

@section('title', 'History')

@section('content')
    <div class="container mx-auto">
        {{-- Slot --}}
        <div class="w-100 card p-3" style="background-color: #7d4e23;">
            <div class="">
                <a href="{{route('index')}}" class="btn btn-outline-light float-start">Back</a>
                <div class="my-3 text-light float-end fs-5">{{cache()->get($cache)['time']->diffForHumans()}}</div>
            </div>
            {{-- Display Word set --}}
            <div class="card_container my-2 mx-auto w-100">
                @foreach (cache()->get($cache)['wordSet'] as $word)
                    <div class="card_child card p-3 me-1 text-light border border-2 border-light" style="background-color: #084d10;">
                        <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br>{{$word->word}}</div>
                        <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br>{{$word->definition}}</div>
                        <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br>{{$word->type}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
