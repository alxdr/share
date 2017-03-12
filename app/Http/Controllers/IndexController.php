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
	$user = Auth::user();
	if ($user === NULL) {
	    return view('auth.login');
	}
	else {
	    return view('home');
	}
    }

    public function index() {
	$result = $this->pdo->query("SELECT i.item_id, i.description, i.availability, b.bid_value FROM Items i LEFT OUTER JOIN Bid_history b on i.item_id = b.item_id ORDER BY i.item_id");
	$table = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	    $table[] = $row;
	}
	return view('index')->with('table', $table);
    }
}
