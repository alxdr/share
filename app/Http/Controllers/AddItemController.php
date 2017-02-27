<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection as Conn;
use \PDO as PDO;

class AddItemController extends Controller
{
    private $pdo;

    public function __construct() {
    	try {
	    $this->pdo = Conn::connect();
    	} catch (\PDOException $err) {
	    echo $err.getMessage();
    	}
    }

  public function add_item() {
    return view('add_item');
  }

  public function add_item_post(Request $req) {



    //echo($req -> description);
    $user_id = Auth::id();
    //echo("INSERT INTO Items (item_id, description, owner) VALUES ($count," .$req -> description. ", ".$user_id.")");

    $this->pdo->exec("INSERT INTO Items (availability, description, owner) VALUES ('TRUE', '" .$req -> description. "', ".$user_id.")");
    //$this->pdo->exec("INSERT INTO Items (item_id, availability, description, owner) VALUES ($count, 'TRUE', '".$req -> description."', 11)");
    return redirect('main');
    }
}
