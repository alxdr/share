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
        $bidder=Auth::id();
        $curr_time=date('Y-m-d G:i:s');

       
        $tempResult=$this->pdo->query("SELECT availability,starting_bid,highest_bid_id,min_bid_increment FROM items WHERE item_id=".$item_id);
        $row=$tempResult->fetch(PDO::FETCH_ASSOC);
        
        $itemOwner=$this->pdo->query("SELECT owner FROM items WHERE item_id=".$item_id)->fetch(PDO::FETCH_ASSOC)['owner'];

        if($itemOwner==$bidder){
            $message='Cannot bid for your own item';
            echo "<script type='text/javascript'>alert('$message');</script>";
            return view('bid_item');
        } else {
            if($row['availability']==1){
                if($row['highest_bid_id']==NULL){
                    $nextMinBid=$row['starting_bid']+$row['min_bid_increment'];
                    if($nextMinBid>$point){
                        $message='need at least '.$nextMinBid.' to get successful bid';
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        return view('bid_item');
                    } else {
                        $this->pdo->exec("INSERT INTO bid_history (item_id,bidder,bid_value,bid_time) VALUES(".$item_id.", ".$bidder.", ".$point.", '".$curr_time."')");
                        $highestBidId=$this->pdo->query("SELECT bid_id FROM bid_history WHERE item_id=".$item_id." and bidder=".$bidder." and bid_value=".$point." and bid_time='".$curr_time."'")->fetch(PDO::FETCH_ASSOC)['bid_id'];
                        $this->pdo->exec("UPDATE items SET highest_bid_id=".$highestBidId." WHERE item_id=".$item_id);

                        $message='Bid Successfully!';
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        return view('home');
                    }
                } else {
                    $highestBidValue=$this->pdo->query("SELECT bid_value FROM bid_history WHERE bid_id=".$row['highest_bid_id'])->fetch(PDO::FETCH_ASSOC)['bid_value'];
                    $nextMinBid=$highestBidValue+$row['min_bid_increment'];
                    if($nextMinBid>$point){
                        $message='need at least '.$nextMinBid.' to get successful bid';
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        return view('bid_item');
                    } else {
                        $this->pdo->exec("INSERT INTO bid_history (item_id,bidder,bid_value,bid_time) VALUES(".$item_id.", ".$bidder.", ".$point.", '".$curr_time."')");
                        $highestBidId=$this->pdo->query("SELECT bid_id FROM bid_history WHERE item_id=".$item_id." and bidder=".$bidder." and bid_value=".$point." and bid_time='".$curr_time."'")->fetch(PDO::FETCH_ASSOC)['bid_id'];
                        $this->pdo->exec("UPDATE items SET highest_bid_id=".$highestBidId." WHERE item_id=".$item_id);
                        $message='Bid Successfully!';
                        echo "<script type='text/javascript'>alert('$message');</script>";
                        return view('home');
                    }
                }   
            } else {
                $message='This item is not available for bidding now';
                echo "<script type='text/javascript'>alert('$message');</script>";
                return view('bid_item');
            }
        }
    }
}





