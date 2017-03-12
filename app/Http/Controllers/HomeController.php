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
        $user_id = Auth::id();
        echo $user_id;

        $loans_result = $this->pdo->query("SELECT i.item_id, i.description, i.availability, l.loan_date, l.return_date
            FROM Items i LEFT OUTER JOIN Loan_history l ON i.item_id = l.item_id WHERE i.owner = $user_id ORDER BY i.item_id");
    	$loans_table = [];
    	while ($row = $loans_result->fetch(PDO::FETCH_ASSOC)) {
    	    $loans_table[] = $row;
    	}


        $items_result = $this->pdo->query("SELECT i.item_id, i.description, i.availability, b.bid_value
            FROM Items i LEFT OUTER JOIN Bid_history b ON i.item_id = b.item_id WHERE i.owner = $user_id ORDER BY i.item_id");
    	$items_table = [];
    	while ($row = $items_result->fetch(PDO::FETCH_ASSOC)) {
    	    $items_table[] = $row;
    	}

        return view('home')->with('items_table', $items_table)->with('loans_table', $loans_table);
    }
}
