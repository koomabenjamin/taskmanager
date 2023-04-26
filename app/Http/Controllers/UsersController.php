<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UsersValidationRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Json\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name', 'ASC')->Paginate(6);

        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $users = User::orderBy('name', 'ASC')->where('name', 'LIKE', '%'.$search.'%')->Paginate(6);
        }

        return response()->json($users);
    }

    /**
     * Display a Specific User.
     *
     * @return \Illuminate\Json\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Json\Response
     */
    public function store(UsersValidationRequest $request)
    {
        $request->validated();

        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'image' => $request->input('image')
        ]);

        return response()->json('User created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Json\Response
     */
    public function edit(User $users)
    {
        return view('users.edit')->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Json\Response
     */
    public function update(UsersValidationRequest $request, $id)
    {
        $request->validated();

        $users = User::where('id', $id)
        ->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'image' => $request->input('image')
        ]);

        
        return response()->json('User Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Json\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('User deleted successfully.');
    }
}