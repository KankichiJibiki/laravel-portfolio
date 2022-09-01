@extends('layouts.app')

@section('title', 'Edit Word')

@section('content')
    <div class="w-75 mx-auto card p-3 row" style="background-color: #7d4e23;">
        <h2 class="card card-title border-0 text-center my-2 p-2 text-light fw-bold" style="background-color: #a37a18;">Edit Word</h2>
        <form action="/words/{{$word->uuid}}" method="post">
            @csrf
            @method('PATCH')

            <div class="card p-3 w-75 mx-auto border-light my-3 col" style="background-color: #084d10;">
                {{-- word --}}
                @error('word')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                <div class="mb-4 d-flex input-group">
                    <label for="word" class="form-label input-group-text m-0">Word: </label>
                    <input type="text" name="word" id="word" value="{{$word->word}}" class="form-control">
                </div>
                {{-- definition --}}
                @error('definition')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                <div class="mb-4 d-flex input-group">
                    <label for="definition" class="form-label input-group-text m-0">Definition: </label>
                    <input type="text" name="definition" id="definition" value="{{$word->definition}}" class="form-control">
                </div>
                {{-- type --}}
                @error('words_type_id')
                    <div class="text-danger">{{$message}}</div>
                @enderror
                <div class="mb-4 d-flex input-group">
                    <label for="words_type_id" class="form-label input-group-text m-0">Word Type</label>
                    <select name="words_type_id" id="words_type_id" class="form-control">
                        @foreach ($types as $type)
                            @if ($word->words_type_id == $type->id)
                                <option value="{{$type->id}}" selected>{{$type->type}}</option>
                            @else
                                <option value="{{$type->id}}">{{$type->type}}</option>
                            @endif
                        @endforeach
                    @error('word')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    </select>
                </div>
            </div>
            {{-- btn --}}
            <div class="col w-75 mx-auto">
                <div class="div">
                    <a href="{{route('index')}}" class="btn btn-outline-dark text-light float-start w-25">Back</a>
                </div>
                <div class="div">
                    <button type="submit" class="btn btn-outline-success text-light float-end w-25">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
