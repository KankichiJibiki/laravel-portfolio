@extends('layouts.app')

@section('title', 'Slot')

@section('content')
    <div class="main_container container mx-auto">

        {{-- left and top history & primary --}}
        <div class="left_top_container card p-3 mb-3 border-success">
            <h4 class="text-center mb-3">Slot History</h4>
            <div class="cache_container">
                @if (cache()->has('oldest'))
                    <a href="" class="container card p-2">
                        <div>{{cache()->get('oldest')['time']->diffForHumans()}}</div>
                        @foreach (cache()->get('oldest')['wordSet'] as $wordHistory)
                            <div class="text-muted text-center p-1">{{$wordHistory->word}}</div>
                        @endforeach
                    </a>
                @endif
                @if (cache()->has('second'))
                    <a href="" class="container card p-2">
                        <div>{{cache()->get('second')['time']->diffForHumans()}}</div>
                        @foreach (cache()->get('second')['wordSet'] as $wordHistory)
                            <div class="text-muted text-center p-1">{{$wordHistory->word}}</div>
                        @endforeach
                    </a>
                @endif
                @if (cache()->has('latest'))
                    <a href="" class="container card p-2">
                        <div>{{cache()->get('latest')['time']->diffForHumans()}}</div>
                        @foreach (cache()->get('latest')['wordSet'] as $wordHistory)
                            <div class="text-muted text-center p-1">{{$wordHistory->word}}</div>
                        @endforeach
                    </a>
                @endif
                @if(!cache('oldest'))
                    <div class="text-muted text-center my-5 fs-3">No History</div>
                @endif
            </div>
        </div>
        {{-- right Slot --}}
        <div class="right_down_container container card p-3 mb-3" style="background-color: #7d4e23;">
            {{-- slot btn --}}
            <div class="my-2 mx-auto">
                <a href="{{route('displaySlotResult')}}" class="btn btn-success btn-lg">Slot Now!</a>
            </div>

            {{-- Display Word set --}}
            <div class="card_container my-2">
                @foreach ($wordSet as $word)
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
