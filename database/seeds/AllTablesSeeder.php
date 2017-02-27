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
	for ($i = 1; $i <= $users_limit; $i++) {
	    $pass = pg_escape_string($faker->valid($validator)->password);
	    $queryStr = "INSERT INTO Users (email, password, is_admin) VALUES ('$faker->email', '$pass', FALSE)";
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
	    $queryStr = "INSERT INTO Items (description, availability, owner, bid_end_date) VALUES ('$str', TRUE, $id, NULL)";
	    $pdo->exec($queryStr);
	}
	
	for ($i = 1; $i <=$items_limit; $i++) {
	    if ($faker->randomDigit % 2 == 0) {
	    	$bidder_id = $faker->numberBetween($min=1,$max=10);
		$bid = $faker->numberBetween($min=1,$max=200);
	    	$queryStr = "INSERT INTO Bids (item_id, highest_bid, highest_bidder) VALUES ($i, $bid, $bidder_id)";
	    	$pdo->exec($queryStr);
		
	    }
	    else {
	  	continue;
	    }
	}
    }
}
