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
	$limit = 100;
	$validator = function($word) {
	    return strlen($word) <= 20;
	};
	for ($i = 1; $i <= 10; $i++) {
	    $pass = pg_escape_string($faker->valid($validator)->password);
	    $queryStr = "INSERT INTO Users (user_id, email, password, is_admin) VALUES ($i, '$faker->email', '$pass', FALSE)";
	    $pdo->exec($queryStr);
	}
	
	for ($i = 1; $i <= $limit; $i++) {
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
	    $id = $faker->numberBetween($min=1,$max=10);
	    $queryStr = "INSERT INTO Items (item_id, description, availability, owner, highest_bid, bid_end_date) VALUES ($i, '$str', TRUE, $id, NULL, NULL)";
	    $pdo->exec($queryStr);
	}
    }
}
