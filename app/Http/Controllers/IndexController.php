<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function index() {
	$result = $this->pdo->query("SELECT * FROM Items");
	$table = [];
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	    $table[] = $row;
	}
	return view('index')->with('table', $table);
    }
}
