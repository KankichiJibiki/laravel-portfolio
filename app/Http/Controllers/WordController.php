<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

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

    public function __construct(Word $word){
        $this->now = Carbon::now();
        $this->word = $word;
        $this->types = new Type();
        $this->wordSet = [];
    }

    public function rules(){
        return [
            'word' => ['required', 'string', 'max:50'],
            'definition' => ['required', 'string', 'max:150'],
            'type_id' => ['required'],
        ];
    }

    public function index()
    {
        // $word = $this->word->all()->first();
        // $type = $word->type;
        // return $word;

        $word_pagination = Word::where('user_id', '=', Auth::id())->latest()->paginate(6);
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

    public function createMap(){
        $wordMapAll = [];
        $words = Auth::user()->words;
        $count = 0;

        foreach($words as $word){
            $wordMapAll[$count] = $word;
            $count++;
        }
        return $wordMapAll;
    }

    public function pickUp(){
        $wordMap = $this->createMap();

        if(count($wordMap) < 5) $this->wordSet = $wordMap;
        else {
            while(count($this->wordSet) < 5){
                $randomNum = random_int(0, count($wordMap)-1);

                if(array_key_exists($randomNum, $this->wordSet) != true) $this->wordSet[$randomNum] = $wordMap[$randomNum];
            }
        }

        $this->storeCache();

        return view('words.slot')
            ->with('wordSet',$this->wordSet)
            ->with('types', $this->types->all());
    }


    public function storeCache(){
        $wordCache = [
            'wordSet'=>$this->wordSet,
            'time'=>now()
        ];

        if(Cache::has('latest')){
            Cache::forget('oldest');
            $second = Cache::pull('second');
            Cache::put('oldest', $second, now()->addDay());
            // Cache::forget('second');
            $latest = Cache::pull('latest');
            Cache::put('second', $latest, now()->addDay());
            // Cache::forget('latest');
            Cache::put('latest', $wordCache, now()->addDay());
        }
        else if(Cache::has('oldest') && Cache::has('second') && !Cache::has('latest')) Cache::put('latest', $wordCache, now()->addDay());
        else if(Cache::has('oldest')) Cache::put('second', $wordCache, now()->addDay());
        else Cache::put('oldest', $wordCache, now()->addDay());
    }


    public function showCache($cache){
        return view('words.showHistory')
        ->with('types', $this->types->all())
        ->with('cache', $cache);
    }
}
