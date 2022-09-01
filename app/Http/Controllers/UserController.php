<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Type;

class UserController extends Controller
{

    const LOCAL_STORAGE_FOLDER = 'public/image/';
    public $user;
    public $types;

    public function __construct(User $user, Type $types)
    {
        $this->user = $user;
        $this->types = $types;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rules(){
        return [
            'username'=>['required', 'string','min:5', 'max:50'],
            'first_name'=>['required','string', 'max:50'],
            'last_name'=>['required','string', 'max:50'],
            'email'=>['required', 'email', 'string', 'max:255'],
        ];
    }


    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.profile')->with('types', $this->types->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('types', $this->types->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveImage($request){
        $imageName = time() . "." . $request->avatar->extension();
        $request->avatar->storeAs(self::LOCAL_STORAGE_FOLDER, $imageName);

        return $imageName;
    }

    public function update(Request $request, User $user)
    {
        $request->validate($this->rules());
        if($request->avatar){
            $imageName = ['avatar'=>$this->saveImage($request)];
            $user->fill(array_merge($request->all(), $imageName))->save();
        } else $user->fill(array_merge($request->all()))->save();

        // return $imageName;
        return redirect()->back()
        ->with('types', $this->types->all())
        ->with('success_update', 'Updated user data successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
