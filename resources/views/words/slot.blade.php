@extends('layouts.app')

@section('title', 'Slot')

@section('content')
    {{-- history & primary --}}
    <div class="container card p-3 mb-3 d-flex border-success">
        <h4 class="text-center">Primary Word!</h4>
        <div class="card">
            {{-- @if ($historyStack->isNotEmpty())
                @foreach ($historyStack as $history)
                    <div>{{$history["wordSet"]}}</div>
                    <div>{{$history["time"]}}</div>
                @endforeach
            @endif --}}
        </div>
    </div>
    <div class="container mx-auto">
        {{-- Slot --}}
        <div class="w-100 card p-3" style="background-color: #7d4e23;">
            {{-- slot btn --}}
            <div class="my-2 mx-auto">
                <a href="{{route('displaySlotResult')}}" class="btn btn-success btn-lg">Slot Now!</a>
            </div>

            {{-- Display Word set --}}
            <div class="my-2 mx-auto d-flex w-100">
                @foreach ($wordSet as $word)
                    <div class="card p-3 me-1 flex-fill text-light border border-2 border-light" style="background-color: #084d10;">
                        <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br>{{$word->word}}</div>
                        <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br>{{$word->definition}}</div>
                        <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br>{{$word->type}}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
