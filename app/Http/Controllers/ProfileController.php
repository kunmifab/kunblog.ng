<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $myPosts = Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('profile.dashboard', ['myPosts'=> $myPosts]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::where('id', $id)->firstOrFail();
        return view('profile.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'firstname' => 'required|max:255|string',
            'lastname' => 'max:255|string|nullable',
            'phone' => 'string|nullable',
            'dob' => 'date|nullable',
            'profile_picture' => 'mimes:png,jpg,jpeg|nullable'

        ]);

        $user = User::findOrFail(auth()->user()->id);

        if($request->profile_picture != null){
            if($user->profile_picture != null){
                Storage::delete($user->profile_picture);
            }

            $profile_picture = $request->file('profile_picture')->storePublicly('profile_picture');
            move_uploaded_file($profile_picture, public_path('profile_picture'));
            $user->profile_picture = $profile_picture;
        }

        $user->firstname = Str::title($request->firstname);
        $user->lastname = Str::title($request->lastname);
        $user->phone = $request->phone;
        $user->date_of_birth = $request->dob;
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Your Profile Has Been Updated Successfully');
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
