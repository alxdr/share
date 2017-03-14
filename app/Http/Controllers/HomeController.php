<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection as Conn;
use \PDO as PDO;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     private $pdo;

     public function __construct() {
     	try {
 	    $this->pdo = Conn::connect();
     	} catch (\PDOException $err) {
 	    echo $err.getMessage();
     	}
     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	if (Auth::user()->is_admin) {
	    return redirect('admin/1');
	}
        $user_id = Auth::id();

        $bids_result = $this->pdo->query("SELECT i.item_id, i.description,
            i.bid_end_date, b.bid_value FROM Items i, bid_history b
            WHERE b.bidder = $user_id AND i.highest_bid_id = b.bid_id AND i.availability = 'TRUE' ORDER BY i.item_id");
    	$bids_table = [];
    	while ($row = $bids_result->fetch(PDO::FETCH_ASSOC)) {
    	    $bids_table[] = $row;
    	}

        $loans_result = $this->pdo->query("SELECT i.item_id, i.description, l.loan_date, l.return_date
            FROM Items i LEFT OUTER JOIN Loan_history l ON i.item_id = l.item_id
            WHERE i.owner = $user_id AND i.availability = 'FALSE' ORDER BY i.item_id");
    	$loans_table = [];
    	while ($row = $loans_result->fetch(PDO::FETCH_ASSOC)) {
    	    $loans_table[] = $row;
    	}


        $items_result = $this->pdo->query("SELECT i.item_id, i.description, b.bid_value
            FROM Items i LEFT OUTER JOIN Bid_history b ON i.item_id = b.item_id
            WHERE i.owner = $user_id AND i.availability = 'TRUE' ORDER BY i.item_id");
    	$items_table = [];
    	while ($row = $items_result->fetch(PDO::FETCH_ASSOC)) {
    	    $items_table[] = $row;
    	}

        return view('home')-> with('bids_table', $bids_table)
        ->with('items_table', $items_table) ->with('loans_table', $loans_table) ;
    }
}
