<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as faker;

class AdminController extends Controller
{
    public function admin() {
	return redirect('admin/1');
    }
    public function index($id) {
	if ($id == 1) {
	    $table = DB::select('SELECT * FROM items');
	    $active = 'items';
	}
	else if ($id == 2) {
	    $table = DB::select('SELECT user_id, email, is_admin FROM users');
	    $active = 'users';
	}
	else if ($id == 3) {
	    $table = DB::select('SELECT * FROM bid_history');
	    $active = 'bids';
	}
	else if ($id == 4) {
	    $table = DB::select('SELECT * FROM loan_history');
	    $active = 'loans';
	}
	else {
	    abort(404);
	}
    	return view('admin.console')->with('active', $active)->with('table', $table);
    }

    public function edit(Request $req) {
	if ($req->submit == "insert") {
	    $id = $req->id;
	    if ($req->table == "items") {
		return view('admin.insert_items');
	    }
	    else if ($req->table == "users") {
		return view('admin.insert_users');
	    }
	    else if ($req->table == "bids") {
		return view('admin.insert_bids');
	    }
	    else if ($req->table == "loans") {
		return view('admin.insert_loans');
	    }
	    else {
		abort(404);
	    }
	}
	if ($req->submit == "update" || $req->submit == "insert") {
	    $id = $req->id;
	    if ($req->table == "items") {
		$data = DB::select('SELECT * FROM items WHERE item_id = :id', ['id'=>$id]);
		return view('admin.edit_items')->with('data', $data);
	    }
	    else if ($req->table == "users") {
		$data = DB::select('SELECT user_id, email, password, is_admin FROM users WHERE user_id = :id', ['id'=>$id]);
		return view('admin.edit_users')->with('data', $data);
	    }
	    else if ($req->table == "bids") {
		$data = DB::select('SELECT * FROM bid_history WHERE bid_id = :id', ['id'=>$id]);
		return view('admin.edit_bids')->with('data', $data);
	    }
	    else if ($req->table == "loans") {
		$data = DB::select('SELECT * FROM loan_history WHERE loan_id = :id', ['id'=>$id]);
		return view('admin.edit_loans')->with('data', $data);
	    }
	    else {
		abort(404);
	    }
	}
	else if ($req->submit == "delete") {
	    $id = $req->id;
	    if ($req->table == "items") {
		$result = DB::delete('DELETE FROM items WHERE item_id = :id', ['id'=>$id]);
	    	return redirect('/admin/1');
	    }
	    else if ($req->table == "users") {
		$result = DB::delete('DELETE FROM users WHERE user_id = :id', ['id'=>$id]);
	    	return redirect('/admin/2');
	    }
	    else if ($req->table == "bids") {
		$result = DB::delete('DELETE FROM bid_history WHERE bid_id = :id', ['id'=>$id]);
	    	return redirect('/admin/3');
	    }
	    else if ($req->table == "loans") {
		$result = DB::delete('DELETE FROM loan_history WHERE loan_id = :id', ['id'=>$id]);
	    	return redirect('/admin/4');
	    }
	    else {
		abort(404);
	    }
	}
	else {
	    abort(404);
	}
    }

    public function edit_item(Request $req) {
	if ($req->availability == 1)
	    $avail = 'TRUE';
	else {
	    $avail = 'FALSE';
	}
    	$result = DB::update('UPDATE items SET description = ?, availability = ?, bid_end_date = ?, bid_start_date = ?, starting_bid = ?, min_bid_increment = ?, highest_bid_id = ?, owner = ? WHERE item_id = ?', [$req->description, $avail, $req->bid_end_date, $req->bid_start_date, $req->starting_bid, $req->min_bid_increment, $req->highest_bid_id, $req->owner, $req->item_id]);
	return redirect('/admin/1');
    }

    public function insert_item(Request $req) {
	if ($req->availability == 1)
	    $avail = 'TRUE';
	else {
	    $avail = 'FALSE';
	}
    	$result = DB::insert('INSERT INTO items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [$req->description, $avail, $req->bid_end_date, $req->bid_start_date, $req->starting_bid, $req->min_bid_increment, $req->highest_bid_id, $req->owner]);
	return redirect('/admin/1');
    }

    public function edit_user(Request $req) {
    	if ($req->is_admin == 1)
	    $is_admin = 'TRUE';
	else {
	    $is_admin = 'FALSE';
	}
	$result = DB::update('UPDATE users SET email = ?, password = ?, is_admin = ? WHERE user_id = ?', [$req->email, bcrypt($req->password), $is_admin, $req->user_id]);
	return redirect('/admin/2');
    }

    public function insert_user(Request $req) {
    	if ($req->is_admin == 1)
	    $is_admin = 'TRUE';
	else {
	    $is_admin = 'FALSE';
	}
	$result = DB::insert('INSERT INTO users (email, password, is_admin) VALUES (?, ?, ?)', [$req->email, bcrypt($req->password), $is_admin]);
	return redirect('/admin/2');
    }

    public function edit_bid(Request $req) {
	$result = DB::update('UPDATE bid_history SET item_id = ?, bidder = ?, bid_value = ?, bid_time = ? WHERE bid_id = ?', [$req->item_id, $req->bidder, $req->bid_value, $req->bid_time, $req->bid_id]);
	return redirect('/admin/3');
    }

    public function insert_bid(Request $req) {
	$result = DB::insert('INSERT INTO bid_history (item_id, bidder, bid_value, bid_time) VALUES (?, ?, ?, ?)', [$req->item_id, $req->bidder, $req->bid_value, $req->bid_time]);
	return redirect('/admin/3');
    }

    public function edit_loan(Request $req) {
	$result = DB::update('UPDATE loan_history SET return_date = ?, loan_date = ?, item_id = ?, user_id = ? WHERE loan_id = ?', [$req->return_date, $req->loan_date, $req->item_id, $req->user_id, $req->loan_id]);
	return redirect('/admin/4');
    }

    public function insert_loan(Request $req) {
	$result = DB::insert('INSERT INTO loan_history (return_date, loan_date, item_id, user_id) VALUES (?, ?, ?, ?)', [$req->return_date, $req->loan_date, $req->item_id, $req->user_id]);
	return redirect('/admin/4');
    }

    public function stats() {
	$faker = faker::create();
	$result = DB::select('
		SELECT COUNT(*), bid_time::DATE 
		FROM bid_history 
		GROUP BY bid_time::DATE
		LIMIT 10');
	$avg_result = DB::select('
		SELECT AVG(num) AS average FROM (
			SELECT COUNT(*) AS num, bid_time::DATE AS date 
			FROM bid_history 
			GROUP BY bid_time::DATE
			LIMIT 10) 
		AS subtable');
	$days = 9;
	//$keys = range(0, $days);
	//$vals = array_fill(0, $days + 1, 0);
	//$data = array_combine($keys, $vals);
	$avg = $avg_result[0]->average;
	$now_date = date_create(date('Y-m-d'));
	foreach($result as $row) {
	    $date = date_create($row->bid_time);
	    $diff = date_diff($now_date, $date)->days;
	    $data[$diff] = $row->count;
	}
	krsort($data);
	$max_result = DB::select('SELECT MAX(bid_value) FROM bid_history');
	$max = $max_result[0]->max;
	$min_result = DB::select('SELECT MIN(bid_value) FROM bid_history');
	$min = $min_result[0]->min;
	$pop_result = DB::select('
		SELECT u.email AS email, COUNT(b.item_id) AS count 
		FROM bid_history b, items i, users u 
		WHERE b.item_id = i.item_id
		AND i.owner = u.user_id 
		GROUP BY u.email
		ORDER BY COUNT(b.item_id) DESC, u.email ASC
		LIMIT 10');
	$avg_bid = DB::select('SELECT AVG(bid_value) FROM bid_history')[0]->avg;
	$total_users = DB::select('SELECT COUNT(*) FROM users')[0]->count;
	$total_items = DB::select('SELECT COUNT(*) FROM items')[0]->count;
	$total_bids = DB::select('SELECT COUNT(*) FROM bid_history')[0]->count;
	$total_loans = DB::select('SELECT COUNT(*) FROM loan_history')[0]->count;
	return view('admin.stats', compact('data', 'avg', 'days', 'max', 'min', 'pop_result', 'avg_bid', 'total_users', 'total_items', 'total_bids', 'total_loans'));
    }
}
