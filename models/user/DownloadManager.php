<?php
	
	
	class DownloadManager
	{
		protected PDO $DB;
		
		public function __construct (PDO $db)
		{
			$this->setDB($db);
		}
		
		private function setDB (PDO $db) : void
		{
			if ($db->query("SELECT * FROM downloads LIMIT 0,1")) {
				$this->DB = $db;
			} else {
				trigger_error("Require a valid PDO Object to initialize UserManager");
			}
		}
		
		public function delete (Download $dl) : bool
		{
			$id = $dl->getUser_id();
			if (!empty($id)) {
				$_query = "DELETE FROM downloads WHERE user_id = '$id'";
				$res = $this->DB->exec($_query);
				return !($res === false);
			}
			return false;
		}
		
		public function update (Download $dl) : bool
		{
			$id = $dl->getUser_id();
			$downloads = $dl->getDownloadStr();
			$_old = $this->select($dl);
			if (!empty($id) && !empty($downloads) && !empty($_old)) {
				$new_downloads = $_old[0]['downloads'] . $dl->getDownloadStr();
				$new_downloads = preg_replace("#(')#", "\'", $new_downloads);
				$_query = "UPDATE downloads SET `downloads` = '$new_downloads' WHERE user_id = '$id'";
				$_update_res = $this->DB->exec($_query);
				return ($_update_res !== false);
			}
			return false;
		}
		
		public function select (Download $dl) : array
		{
			if (!empty($dl->getUser_id())) {
				$_query = "SELECT * FROM downloads WHERE user_id = '" . $dl->getUser_id() . "'";
				$_res = $this->DB->query($_query)->fetchAll(PDO::FETCH_ASSOC);
			}
			return $_res ?? [];
		}
		
		public function add (Download $dl) : bool
		{
			$id = $dl->getUser_id();
			$download = $dl->getDownloadStr();
			if (empty($this->select($dl))) {
				$_query = "INSERT INTO downloads SET user_id = '$id', downloads = '$download'";
				$_res = $this->DB->exec($_query);
				return !($_res === false);
			}
			return false;
		}
		
	}