<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obstacle;

class ObstacleController extends Controller
{
    public $user;

    // define user
    public function __construct(Request $request)
    {
        $this->user = User::find($request->post('id'));
    }
    
    // create
    public function new(Request $request)
    {
        $obstacle = new Obstacle;
        $obstacle->user_id = $this->user->id;
        $obstacle->body = $request->post('body');
        $obstacle->complete = 0;
        $obstacle->save();
        return response()->json($this->user);
    }

    // read
    public function list()
    {
        return response()->json([
                'id' => $this->user->id,
                'session_code' => $this->user->session_code,
                'data' => $this->user->obstacles->all()
            ]);
    }

    // update
    public function update(Request $request, $user_id, $session_code)
    {
        // find the user with the provided id
        $user = User::find($user_id);
        $obstacle = Obstacle::find($request->id);

        // check to see if the provided session code matches
        if($session_code == $user->session_code)
        {
            // check to see if the user owns the obstacle
            if($user_id == $obstacle->user->id)
            {
                $obstacle->body = $request->post('body');
                $obstacle->complete = $request->post('complete');
                $obstacle->save();

                // update the users session code
                $user->session_code = bin2hex(random_bytes(21));
                $user->save();
                return response()->json($user);
            } else {
                return response('Forbidden', 403);
            }

            $user->name = $request->post('name');
            $user->email = $request->post('email');
            $user->session_code = bin2hex(random_bytes(21));
            $user->save();
            return response()->json($user);
        } else {
            return response('Unauthorized', 401);
        }
    }

    // delete
    public function delete(Request $request, $user_id, $session_code)
    {
        $user = User::find($user_id);
        if($user->session_code == $session_code)
        {
            $obstacle = Obstacle::find($request->post('id'));
            // make sure the user is trying to delete their own stuff
            if($obstacle->user->id == $user_id)
            {
                $obstacle->delete();

                // update the users session code
                $user->session_code = bin2hex(random_bytes(21));
                $user->save();
                return response()->json($user);
            } else {
                return response('Forbidden', 403);
            }
            
        }   else    {
            return response('Unauthorized', 401);
        }
    }
}
