<?php
//    not intended to be secure
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // create a new user
    public function new(Request $request)
    {
        $user = new User;
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->session_code = bin2hex(random_bytes(21));
        $user->save();
        return response()->json($user);
    }
    
    // read user list
    public function list()
    {
        return response()->json(User::all());
    }

    // update user
    public function update(Request $request)
    {
        // find the user with the provided id
        $user = User::find($request->post('id'));

        // update the record
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->save();
        return response()->json($user);
    }

    // delete user
    public function delete(Request $request){
        User::find($request->post('id'))->delete();
        return response('Accepted', 202);
    }
}
