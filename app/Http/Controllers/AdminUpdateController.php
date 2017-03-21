<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as faker;
use App\Connection as Conn;
use \PDO as PDO;

class AdminUpdateController extends Controller
{
  private $pdo;

  public function __construct() {
    try {
    $this->pdo = Conn::connect();
    } catch (\PDOException $err) {
    echo $err.getMessage();
    }
  }

    public function admin_update(Request $req) {
      $bid_end_table = DB::select("SELECT i.item_id, i.description, i.bid_end_date, b.bid_value
         FROM items i FULL OUTER JOIN bid_history b ON i.highest_bid_id = b.bid_id WHERE i.availability='TRUE'
         AND bid_end_date <= NOW()");
      $loan_end_table = DB::select("SELECT l.loan_id, i.item_id, i.description, i.bid_end_date, l.return_date
        FROM items i, loan_history l WHERE i.item_id = l.item_id AND i.availability='FALSE'
        AND l.return_date <= NOW()");
      return view('admin/admin_update')->with('bid_end_table', $bid_end_table)->with('loan_end_table', $loan_end_table);
    }
    public function admin_update_end_bid(Request $req) {
      if(isset($_GET['item_id'])) {
          $item_id = $_GET['item_id'];
      } else {
          $item_id = $req -> item_id;
      }

      $result = $this->pdo->query("SELECT i.description, i.owner, b.bidder FROM items i, bid_history b
        WHERE i.highest_bid_id = b.bid_id AND i.item_id = $item_id");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $user  = $row['bidder'];

      $curr_time = date('Y-m-d G:i:s');
      $end_time  = date('Y-m-d G:i:s', mktime(0, 0, 0, date("m")  , date("d") + (7 * 4), date("Y")));
      $this->pdo->exec("INSERT INTO loan_history (return_date, loan_date, item_id, user_id)
        VALUES('$end_time', '$curr_time', $item_id, $user)");
      $this->pdo->exec("UPDATE items SET availability = 'FALSE'  WHERE item_id = $item_id");

      return redirect('admin_update');
    }

    public function admin_update_end_loan(Request $req) {
      if(isset($_GET['loan_id'])) {
          $loan_id = $_GET['loan_id'];
      } else {
          $loan_id = $req -> loan_id;
      }

      $result = $this->pdo->query("SELECT item_id FROM loan_history
        WHERE loan_id = $loan_id");
      $row = $result->fetch(PDO::FETCH_ASSOC);
      $item_id  = $row['item_id'];

      $curr_time = date('Y-m-d G:i:s');
      $end_time  = date('Y-m-d G:i:s', mktime(0, 0, 0, date("m")  , date("d") + (7 * 4), date("Y")));
      $this->pdo->exec("UPDATE items SET availability = 'TRUE', bid_end_date = '$end_time',
         bid_start_date = '$curr_time', highest_bid_id = NULL WHERE item_id = $item_id");

      return redirect('admin_update');
    }
}
