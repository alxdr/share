<?php

use Illuminate\Database\Seeder;
use App\Connection as conn;

class AllTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$pdo = conn::connect();
        $faker = Faker\Factory::create();
	$items_limit = 100;
	$users_limit = 20;
	$validator = function($word) {
	    return strlen($word) <= 20;
	};

	//make admin as first user
	$admin_email = 'admin@gmail.com';
	$admin_pass = bcrypt('admin123');
	$admin = "INSERT INTO Users (email, password, is_admin) VALUES ('$admin_email', '$admin_pass', TRUE)";
	$pdo->exec($admin);

	for ($i = 1; $i <= $users_limit; $i++) {
	    $pass = pg_escape_string($faker->valid($validator)->password);
	    $email = $faker->unique()->freeEmail;
	    $queryStr = "INSERT INTO Users (email, password, is_admin) VALUES ('$email', '$pass', FALSE)";
	    $pdo->exec($queryStr);
	}

	for ($i = 1; $i <= $items_limit; $i++) {
	    if ($faker->randomDigit % 2 == 0) {
		$name = pg_escape_string($faker->valid($validator)->name);
		$str = "The Autobiography of " . $name;
	    }
	    else {
		$start = "Encyclopedia of ";
		$end = ", Volume ";
		$country = pg_escape_string($faker->valid($validator)->country);
	    	$str = $start . $country . $end . $faker->numberBetween($min=1,$max=12);
	    }
	    $id = $faker->numberBetween($min=1,$max=$users_limit);
	    $queryStr = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner) VALUES ('$str', TRUE, '2017-03-25 13:23:44', '2017-03-11 13:23:44', 100, 10, $i, $id)";
	    $pdo->exec($queryStr);
	}

	for ($i = 1; $i <=$items_limit; $i++) {
	    if ($faker->randomDigit % 2 == 0) {
	    	$bidder_id = $faker->numberBetween($min=1,$max=10);
		    $bid = $faker->numberBetween($min=100,$max=200);
            //$bidder = $faker->numberBetween($min=1,$max=20);
	    	$queryStr = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, $bid, $bidder_id, '2017-03-12 10:23:44')";
	    	$pdo->exec($queryStr);

	    }
	    else {
	  	continue;
	    }
	}
    }
}
