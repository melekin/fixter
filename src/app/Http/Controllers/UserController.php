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
    public function update(Request $request, $user_id, $session_code)
    {
        // find the user with the provided id
        $user = User::find($user_id);

        // check to see if the provided session code matches
        if($session_code == $user->session_code)
        {
            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->session_code = bin2hex(random_bytes(21));
            $user->save();
            return response()->json($user);
        } else {
            return response('Unauthorized', 401);
        }
    }

    // delete user
    public function delete(Request $request, $user_id, $session_code){
        $user = User::find($user_id);
        if($user->session_code == $session_code)
        {
           $user->delete();
           return response('Accepted', 202);
        }   else    {
            return response('Unauthorized', 401);
        }
    }
}
