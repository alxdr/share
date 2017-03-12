<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nahid\Talk\Facades\Talk;
use App\Connection as Conn;
use App\User as user;
use \PDO as PDO;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function convo()
    {
	$conversations = [];
	$result = DB::select('SELECT c.id, u.email FROM conversations c, users u WHERE u.user_id = c.user_two AND c.user_one = :id OR c.user_two = :id AND u.user_id = c.user_one', ['id' => Auth::id()]);
	foreach ($result as $id) {
	    $result2 = DB::select('SELECT m.message, u.email FROM messages m, users u WHERE u.user_id = m.user_id AND m.conversation_id = :id ORDER BY m.created_at DESC', ['id' => $id->id]);
	    $conversations[$id->email] = [];
	    foreach ($result2 as $msg) {
	    	$conversations[$id->email][] = $msg;
	    }
	}
	return view('message.conversations', compact('conversations'));
    }

    public function send()
    {
        return view('message.send');
    }

    public function sending(Request $req)
    {
	Talk::setAuthUserId(Auth::id());
	$result = DB::select('SELECT user_id FROM Users WHERE email = :email', ['email' => $req->email]);
	$id = $result[0]->user_id;
	Talk::sendMessageByUserId($id, $req->message);
        return redirect('message');
    }
}

?>
