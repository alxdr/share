<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection as Conn;
use \PDO as PDO;

class ItemController extends Controller
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
        $user_id = Auth::id();
        $curr_time = date('Y-m-d G:i:s');
        $end_weeks = $req -> weeks;
        $end_time  = date('Y-m-d G:i:s', mktime(0, 0, 0, date("m")  , date("d") + (7 * $end_weeks), date("Y")));
        $this->pdo->exec("INSERT INTO Items (availability, description, bid_end_date, bid_start_date, starting_bid, min_bid_increment, owner)
                            VALUES ('TRUE', '" .$req -> description. "', '" .$end_time. "', '" .$curr_time. "', '" .$req -> starting_bid. "',
                            '" .$req -> min_bid_increment. "', ".$user_id.")");
        return redirect('main');
    }

    public function update_item(Request $req) {
        $user_id = Auth::id();
        if(isset($_GET['item_id'])) {
            $item_id = $_GET['item_id'];
        } else {
            $item_id = $req -> item_id;
        }
        $result = $this->pdo->query("SELECT description, min_bid_increment, bid_end_date FROM Items WHERE item_id = $item_id");
        $table = [];
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $table[] = $row;
        return view('update_item')->with('item_id', $item_id)->with('row', $row);
    }

    public function update_item_post(Request $req) {
        $user_id = Auth::id();
        $item_id = $req -> item_id;
        $end_weeks = $req -> weeks;
        if($req->change_date == 1){
            $end_time  = date('Y-m-d G:i:s', mktime(0, 0, 0, date("m")  , date("d") + (7 * $end_weeks), date("Y")));
        } else {
            $end_time = $req->bid_end_date;    
        }
        $this->pdo->exec("UPDATE Items SET description = '" .$req -> description. "', min_bid_increment =" .$req -> min_bid_increment. ", bid_end_date = '" .$end_time."'
                            WHERE item_id = $item_id");
        return redirect('main');
    }

    public function delete_item_post(Request $req) {
        $user_id = Auth::id();
        $item_id = $req -> item_id;
        $this->pdo->exec("DELETE FROM Items WHERE item_id = $item_id;");
        return redirect('main');
    }
}
