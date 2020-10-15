<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Users\UpdateProfileRequest;

class UsersController extends Controller
{
    //

    public function index() {

        return view('users.index')->with('users', User::all());
    }
    
    public function makeAdmin(User $user) {
         
        $user->role = 'admin';
        $user->save();

        return redirect(route('users.index'))->with('status','User made admin successfully');
    }

    public function deleteUser(User $user) {
         
        $user->delete();

        return redirect(route('users.index'))->with('status','User deleted successfully');
    }

    public function edit() {
        return view('users.edit')->with('user', auth()->user());
    }

    public function update(UpdateProfileRequest $request) {

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);

         return redirect()->back()->with('status', 'User updated successfully.');
    }
}
