@extends('layouts.app')

@section('title', 'Slot')

@section('content')
    <div class="main_container container mx-auto">
        <div class="col-lg-12 col-11 d-flex flex-wrap justify-content-around align-items-start border">
            {{-- left and top history & primary --}}
            <div class="left_top_container col-lg-4 col-12 p-3 mb-3 border-success">
                <h4 class="text-center mb-3">Slot History</h4>
                <div class="cache_container">
                    @if (cache()->has('oldest'))
                        <a href="{{route('showCache', 'oldest')}}" class="container card p-2">
                            <div>{{cache()->get('oldest')['time']->diffForHumans()}}</div>
                            @foreach (cache()->get('oldest')['wordSet'] as $wordHistory)
                                <div class="text-muted text-center p-1">{{$wordHistory->word}}</div>
                            @endforeach
                        </a>
                    @endif
                    @if (cache()->has('second'))
                        <a href="{{route('showCache', 'second')}}" class="container card p-2">
                            <div>{{cache()->get('second')['time']->diffForHumans()}}</div>
                            @foreach (cache()->get('second')['wordSet'] as $wordHistory)
                                <div class="text-muted text-center p-1">{{$wordHistory->word}}</div>
                            @endforeach
                        </a>
                    @endif
                    @if (cache()->has('latest'))
                        <a href="{{route('showCache', 'latest')}}" class="container card p-2">
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
            <div class="right_down_container col-lg-7 col-12 p-3 mb-3" style="background-color: #7d4e23;">
                {{-- slot btn --}}
                <div class="col-12 d-flex justify-content-center">
                    <a href="{{route('displaySlotResult')}}" class="btn btn-success btn-lg">Slot Now!</a>
                </div>

                {{-- Display Word set --}}
                <div class="card_container my-2 d-flex flex-wrap justify-content-center align-items-around">
                    @foreach ($wordSet as $word)
                        <div class="card_child card col-12 col-lg-4 p-3 text-light border border-light border-2 mb-1" style="background-color: #084d10;">
                            <div class="mb-3 fs-4"><span class="text-warning">Word: </span><br>{{$word->word}}</div>
                            <div class="mb-3 fs-4 d-wrap"><span class="text-warning">Definition: </span><br>{{$word->definition}}</div>
                            <div class="mb-3 fs-4"><span class="text-warning">Type: </span><br>{{$word->type->name}}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
