<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Connection as Conn;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pdo = Conn::connect();

	$ddl = [
	    'CREATE TABLE Users (
		user_id SERIAL,
		email VARCHAR(255),
		password VARCHAR(255),
		is_admin BOOLEAN,
		remember_token VARCHAR(100),
		PRIMARY KEY(user_id));',

	    'CREATE TABLE Items (
		item_id SERIAL,
		description VARCHAR(50),
		availability BOOLEAN,
        bid_end_date TIMESTAMP,
        bid_start_date TIMESTAMP,
        starting_bid NUMERIC,
        min_bid_increment INT,
        highest_bid_id INT,
		owner INT,
		PRIMARY KEY(item_id),
		FOREIGN KEY(owner) REFERENCES Users(user_id)
		ON DELETE CASCADE);',

	    'CREATE TABLE Bid_history (
        bid_id SERIAL,
        item_id INT,
        bidder INT,
		bid_value NUMERIC,
        bid_time TIMESTAMP,
		PRIMARY KEY(bid_id),
		FOREIGN KEY(item_id) REFERENCES Items(item_id)
		ON DELETE CASCADE,
		FOREIGN KEY(bidder) REFERENCES Users(user_id)
		ON DELETE CASCADE);',

	    'CREATE TABLE Loan_history (
		return_date TIMESTAMP NOT NULL,
		loan_date TIMESTAMP NOT NULL,
		item_id INT,
		user_id INT,
		PRIMARY KEY(user_id, item_id, loan_date),
		FOREIGN KEY(item_id) REFERENCES Items(item_id)
		ON DELETE CASCADE,
		FOREIGN KEY(user_id) REFERENCES Users(user_id)
		ON DELETE CASCADE);'
	];

	foreach ($ddl as $table) {
	    $pdo->exec($table);
	}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	$pdo = Conn::connect();

        $ddl = ['DROP TABLE IF EXISTS Loan_history;',
		'DROP TABLE IF EXISTS Bid_history;',
		'DROP TABLE IF EXISTS Items;',
		'DROP TABLE IF EXISTS Users;'];

	foreach ($ddl as $table) {
	    $pdo->exec($table);
	}
    }
}
