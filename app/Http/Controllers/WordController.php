<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HistorySlot{
    // public $wordset;
    // public $time;
    public $historyStack;

    // public function __construct(){
    //     $this->wordset = $wordset;
    //     $this->time = $time;
    // }

    public function setWordHistory($wordset, $time){
        // $this->wordset = $wordset;
        // $this->time = $time;
        $this->historyStack[] = [
            'wordSet' => $wordset,
            'time' => $time
        ];
    }
}

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $word;
    public $types;
    public $wordSet;
    public $historyStack;

    public function __construct(Word $word){
        $this->now = Carbon::now();
        $this->word = $word;
        $this->types = new Type();
        $this->wordSet = [];
        $this->historyStack = new HistorySlot();
    }

    public function rules(){
        return [
            'word' => ['required', 'string', 'max:50'],
            'definition' => ['required', 'string', 'max:50'],
            'words_type_id' => ['required'],
        ];
    }

    public function index()
    {
        $word_pagination = Word::paginate(10);
        return view('words.index')
        ->with('words', $word_pagination)
        ->with('types', $this->types->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        $uuid_user_id = ['uuid' => Str::uuid(), 'user_id' => Auth::id()];
        $this->word->create(array_merge($request->all(), $uuid_user_id))->save();

        return redirect()->back()->with('success_create', 'Registered a word successfully!');
    }

    public function type_create(Request $request){
        $uuid = ['uuid' => Str::uuid()];
        $this->types->create(array_merge($request->all(), $uuid))->save();
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        $words = $this->word->all();
        return view('words.edit')->with('word', $word)->with('types', $this->types->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $request->validate($this->rules());
        $uuid_user_id = ['uuid'=>Str::uuid(), 'user_id'=>Auth::id()];
        $word->fill(array_merge($request->all(), $uuid_user_id))->save();

        return redirect()->route('index')->with('success_update', 'Updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect()->back();
    }


    // public function slot(){
    //     return view('words.slot')
    //     ->with('types', $this->types->all());
    // }

    public function createRandoms(){
        $first_id = $this->word->first()->id;
        $last_id = $this->word->latest()->first()->id;
        // if($last_id == null) return null;

        $count = 0;
        while($count < 5){
            $currNum = random_int($first_id, $last_id);
            // $currNum = random_int(1, $last_id);
            // echo $currNum . " ";
            if($this->word->findOrFail($currNum) != null && array_key_exists($currNum, $this->wordSet) != true) {
                $this->wordSet[$currNum] = $this->word->findOrFail($currNum);
                $count++;
            }
        }
    }

    public function pickUp(){
        $this->createRandoms();
        $this->historyStack->setWordHistory($this->wordSet, $this->now);

        return view('words.slot')
            ->with('wordSet',$this->wordSet)
            ->with('historyStack', $this->historyStack)
            ->with('types', $this->types->all());
    }
}
