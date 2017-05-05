<?php	
	class Db {
		private static $instance = NULL;
	
		private function __construct() {}
	
		private function __clone() {}
	
		public static function getInstance() {		
			require_once('config/config_database.php');
			
			if (!isset(self::$instance)) {		
				try {
					$DB_DSN = "mysql:dbname=$DB_NAME;host=$DB_HOST";
					self::$instance = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				}
				catch(PDOException $e) {
					echo "Connection failed: " . $e->getMessage();
				}
 		 	}
  			return self::$instance;
		}
	}
?>