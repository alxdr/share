<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection as Conn;
use \PDO as PDO;

class IndexController extends Controller
{
    private $pdo;

    public function __construct() {
    	try {
	    $this->pdo = Conn::connect();
    	} catch (\PDOException $err) {
	    echo $err.getMessage();
    	}
    }

    public function login() {
	if (Auth::guest()) {
	    return view('auth.login');
	}
	else if (Auth::user()->is_admin) {
	    return redirect('/admin');
	}
	else {
	    return redirect('/home');
	}
    }

    public function index() {
	$result = $this->pdo->query("SELECT i.item_id, i.description, i.availability, i.owner, b.bid_value FROM Items i
    LEFT OUTER JOIN Bid_history b on i.item_id = b.item_id and i.highest_bid_id=b.bid_id WHERE i.availability = 'TRUE' AND bid_end_date >= NOW() ORDER BY i.item_id");
	$table = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	    $table[] = $row;
	}
	return view('index')->with('table', $table);
    }
}
