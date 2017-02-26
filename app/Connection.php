<?php

namespace App;

use \PDO as PDO;

class Connection {
	
	public static function connect() {

		$db = parse_ini_file(".env.ini");
		$info = sprintf("pgsql: host=%s; port=%d; dbname=%s; user=%s; password=%s", $db['DB_HOST'], $db['DB_PORT'], $db['DB_DATABASE'], $db['DB_USERNAME'], $db['DB_PASSWORD']);
		$pdo = new PDO($info);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return $pdo;
	}
}
