<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection as Conn;
use \PDO as PDO;


class BidController extends Controller
{
    private $pdo;

    public function __construct() {
    	try {
	    $this->pdo = Conn::connect();
	   
    	} catch (\PDOException $err) {
	    echo $err.getMessage();
    	}
    }

	public function bid_item() {
		return view('bid_item');
    }

    public function bid_for_item(Request $req) {
    	$item_id=$req->bid_item_id;
    	$point=$req->bid_item_point;
        echo $bidder=Auth::id();
        $temp=$this->pdo->query("SELECT count(*) as total FROM bids WHERE item_id=".$item_id);
        if($temp->fetch(PDO::FETCH_ASSOC)['total']==0){
            $this->pdo->exec("INSERT INTO bids (item_id,highest_bid,highest_bidder) VALUES(".$item_id.", ".$point.", ".$bidder.")");
        } else {
            $cur_highest_point = $this->pdo->query("SELECT highest_bid FROM bids WHERE item_id=".$item_id);
            if($point>$cur_highest_point->fetch(PDO::FETCH_ASSOC)['highest_bid']){
                $this->pdo->exec("UPDATE bids SET highest_bid=".$point." ,highest_bidder=".$bidder." WHERE item_id=".$item_id);
            }
        }
    	

		$result = $this->pdo->query("SELECT * FROM Items");
        $table = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $table[] = $row;
        }
        return view('index')->with('table', $table);
    }
}






