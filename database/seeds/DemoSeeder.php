<?php

use Illuminate\Database\Seeder;
use App\Connection as conn;

class DemoSeeder extends Seeder
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

	//make fake users
	for ($i = 1; $i <= $users_limit; $i++) {
	    $pass = pg_escape_string($faker->valid($validator)->password);
	    $email = $faker->unique()->freeEmail;
	    $queryStr = "INSERT INTO Users (email, password, is_admin) VALUES ('$email', '$pass', FALSE)";
	    $pdo->exec($queryStr);
	}

  //make user as id22
	$admin_email = 'user@gmail.com';
	$admin_pass = bcrypt('user123');
	$admin = "INSERT INTO Users (email, password, is_admin) VALUES ('$admin_email', '$admin_pass', FALSE)";
	$pdo->exec($admin);

	//make fake items
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
	    $id = $faker->numberBetween($min=2,$max=$users_limit);
      $bid_ended = '2017-04-04 00:00:00';
      $bid_not_ended = '2017-04-15 00:00:00';
      $rand = $faker->numberBetween($min=1,$max=40);

      //Create Items
      if($i > 96){
      $queryStr1 = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner)
      VALUES ('$str', TRUE, '$bid_not_ended', '2017-02-28 13:23:44', 100, 10, $i, 22)";
      $pdo->exec($queryStr1);
    } else {
      $queryStr1 = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner)
      VALUES ('$str', TRUE, '$bid_not_ended', '2017-02-28 13:23:44', 100, 10, $i, $id)";
      $pdo->exec($queryStr1);
    }

      //Create Bidders
      $bidder_id = $faker->numberBetween($min=2,$max=10);
	    $bid = $faker->numberBetween($min=100,$max=200);
    	$queryStr = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, $bid, $bidder_id, '2017-04-02 10:23:44')";
    	$pdo->exec($queryStr);
  }
  for ($i = 1; $i <= $items_limit; $i+=5) {
      //User's bidded Items

        $queryStr2 = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, 1000, 22, '2017-04-02 10:23:44')";
        $pdo->exec($queryStr2);

        $countBids=$pdo->query("SELECT COUNT(*) AS count_bids FROM Bid_history")->fetch(PDO::FETCH_ASSOC)['count_bids'];;

        $queryStr4 = "UPDATE ITEMS SET highest_bid_id = ($countBids) WHERE item_id = $i";
        $pdo->exec($queryStr4);

        if($i>10 && $i < 50){
            $pdo->exec("UPDATE ITEMS SET bid_end_date = '2017-04-06 13:23:44' WHERE item_id = $i");
        }
        if($i>30 && $i < 50){
            $pdo->exec("UPDATE ITEMS SET availability = FALSE WHERE item_id = $i");
            $pdo->exec("INSERT INTO Loan_history (return_date, loan_date, item_id, user_id) VALUES ('2017-04-30 10:23:44', '2017-04-02 10:23:44', $i, 22)");
          }
          if($i==46){
              $pdo->exec("UPDATE Loan_history SET return_date = '2017-04-07 00:23:44' WHERE item_id = $i");
            }
   }




	       /*$queryStr1 = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner)
         VALUES ('$str', TRUE, '$bid_ended', '2017-02-28 13:23:44', 100, 10, 22, $id)";
         $pdo->exec($queryStr1);
         $queryStr2 = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, 1000, 22, '2017-04-02 10:23:44')";
         $pdo->exec($queryStr2);
         if($rand == 2){
            $queryStr3 = "INSERT INTO Loan_history (return_date, loan_date, item_id, user_id) VALUES ('2017-04-20 10:23:44', '2017-04-02 10:23:44', $i, 22)";
            $queryStr4 = "UPDATE ITEMS SET availability = FALSE WHERE item_id = $i";
            $pdo->exec($queryStr3);
            $pdo->exec($queryStr4);
         }else{
            $queryStr3 = "INSERT INTO Loan_history (return_date, loan_date, item_id, user_id) VALUES ('2017-04-02 10:23:44', '2017-03-11 10:23:44', $i, 22)";
             $pdo->exec($queryStr3);
         }


       } else {
         if($rand == 4){
           $queryStr = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner)
           VALUES ('$str', TRUE, '$bid_not_ended', '2017-03-30 13:23:44', 100, 10, $i, 22)";$bidder_id = $faker->numberBetween($min=2,$max=10);
     	    $bid = $faker->numberBetween($min=100,$max=200);
         	$queryStr2 = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, $bid, $bidder_id, '2017-04-02 10:23:44')";
         }
         else {
           $queryStr = "INSERT INTO Items (description, availability, bid_end_date, bid_start_date, starting_bid, min_bid_increment, highest_bid_id, owner)
           VALUES ('$str', TRUE, '$bid_not_ended', '2017-03-30 13:23:44', 100, 10, $i, $id)";
           $bidder_id = $faker->numberBetween($min=2,$max=10);
     	    $bid = $faker->numberBetween($min=100,$max=200);
         	$queryStr2 = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, $bid, $bidder_id, '2017-04-02 10:23:44')";

         }
         $pdo->exec($queryStr);
         $pdo->exec($queryStr2);
       }
	    //$pdo->exec($queryStr);
	}
	//make fake bids
	/*for ($i = 1; $i <=$items_limit; $i++) {
    	$bidder_id = $faker->numberBetween($min=2,$max=10);
	    $bid = $faker->numberBetween($min=100,$max=200);
    	$queryStr = "INSERT INTO Bid_history (item_id, bid_value, bidder, bid_time) VALUES ($i, $bid, $bidder_id, '2017-04-02 10:23:44')";
    	$pdo->exec($queryStr);
	}*/
}
}
