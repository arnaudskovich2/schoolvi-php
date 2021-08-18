<?php
	
	
	class UserManager
	{
		protected PDO $DB;
		
		/**
		 * UserManager constructor.
		 * @param PDO $db
		 */
		public function __construct (PDO $db)
		{
			$this->setDB($db);
		}
		
		/**
		 * Sets UserManager PDO Object after verification
		 * @param PDO $db
		 */
		private function setDB (PDO $db) : void
		{
			if ($db->query("SELECT * FROM users LIMIT 0,1")) {
				$this->DB = $db;
			} else {
				trigger_error("Require a valid PDO Object to initialize UserManager");
			}
		}
		
		/**
		 * Add a new user in Database
		 * @param User $user
		 * @return bool
		 */
		public function addUser (User $user) : bool
		{
			$_data = $user->get_user();
			//DESTROYING NON NECESSARY VARIABLES OR THAT CAN CAUSE TROUBLE
			unset($_data['id'], $_data['reset']);
			if (!in_array('--', $_data, true) && !in_array("", $_data, true)) {
				if (!$this->exists($user)) {
					$_data_str = "";
					foreach ($_data as $column => $value) {
						$val = preg_replace("#(')#", "\'", $value);
						$_data_str .= "`$column` = '$val' , ";
					}
					$_data_str = preg_replace("#, $#", "", $_data_str);
					$_query = "INSERT INTO users SET " . $_data_str;
					$_add_result = $this->DB->query($_query);
					if ($_add_result) {
						$_GET_USER = $this->select($user);
						//PREPARING TO CREATE DOWNLOAD ENTRY FOR USER
						$_id = $_GET_USER['id'];
						$_down = "";
						$_user_down = new Download(['user_id' => $_id, 'downloads' => $_down]);
						$_DOWN_MANAGER = new DownloadManager($this->getDB());
						$_DOWN_MANAGER->add($_user_down);
						return true;
					}
					#trigger_error("An unknown error occurred");
					return false;
				}
				#trigger_error("It seems this user already exists");
				return false;
			}
			#trigger_error("Invalid user object given to addUser");
			return false;
		}
		
		/**
		 * Verifies if user exists in database
		 * @param User $user
		 * @return bool
		 */
		public function exists (User $user) : bool
		{
			//GETTING USER PROPS TO USE
			$_user_props = [
				'id' => $user->getId(),
				'name' => $user->getName(),
				'username' => $user->getUsername(),
				'tel' => $user->getTel(),
				'email' => $user->getEmail(),
			];
			//WILL CONTAIN EACH PROP TEST RESULT
			$_TESTS_RESULTS = [];
			//TESTING EXISTENCE BY PROP
			foreach ($_user_props as $prop => $value) {
				if (!empty($value)) {
					$res = $this->DB->query("SELECT * FROM users WHERE $prop = '$value'");
					if (!$res || empty($res->fetchAll())) {
						//IF NOTHING WAS FOUND WE SET FALSE FOR PROP
						$_TESTS_RESULTS[] = false;
					} else {
						//OTHERWISE WE SET TRUE
						$_TESTS_RESULTS[] = true;
					}
				}
			}
			//IF TESTS RETURNED TRUE FOR ONLY ONE PROP WE RETURN TRUE OTHERWISE FALSE
			return in_array(true, $_TESTS_RESULTS, true);
		}
		
		/**
		 * Select an user in database
		 * @param User $user
		 * @return array
		 */
		public function select (User $user) : array
		{
			$id = $user->getUsername();
			if (!empty($id)) {
				$_query = "SELECT * FROM users WHERE username = '$id'";
				$_select_result = $this->DB->query($_query);
				if ($_select_result) {
					$_data = $_select_result->fetch(PDO::FETCH_ASSOC);
					if (!empty($_data)) {
						return $_data;
					}
				}
			}
			#trigger_error("Utilisateur $id introuvable");
			return [];
		}
		
		/**
		 * Returns current PDO object
		 * @return PDO
		 */
		private function getDB () : PDO
		{
			return $this->DB;
		}
		
		/**
		 * Deletes an user in database
		 * @param User $user
		 * @return bool
		 */
		public function deleteUser (User $user) : bool
		{
			$identifier = $user->getUsername();
			if (!empty($identifier) && $this->exists($user)) {
				//DELETING USER
				$_user_id = $this->DB->query("SELECT id FROM users WHERE username = '$identifier'");
				$_user_id = $_user_id->fetch()[0];
				$_query = "DELETE FROM users WHERE username = '$identifier' ";
				$_del_result = $this->DB->query($_query);
				if ($_del_result) {
					//DELETING USER DOWNLOAD HISTORY
					$_user_down = new Download(['user_id' => $_user_id, 'downloads' => ""]);
					$_DOWN_MANAGER = new DownloadManager($this->getDB());
					$_DOWN_MANAGER->delete($_user_down);
					return true;
				}
				#trigger_error("Couldn't delete user");
				return false;
			}
			#trigger_error("User doesn't seem to exist so couldn't delete");
			return false;
		}
		
		/**
		 * Updates a user setting infos to new_user infos
		 * @param User $old_user
		 * @param User $new_user
		 * @return bool
		 */
		public function update (User $old_user, User $new_user) : bool
		{
			$id = $old_user->getUsername();
			$_new_data = $new_user->get_user();
			//DESTROYING NON NECESSARY VARIABLES THAT CAN CAUSE TROUBLE
			unset($_new_data['id']);
			if ($_new_data['reset'] === "--") {
				unset($_new_data['reset']);
			}
			//GOING TO VERIFY VARS BEFORE UPDATE
			
			if ($this->exists($old_user)) {
				//IMPLODING NEW VALUES STATEMENT
				$_data_str = "";
				foreach ($_new_data as $column => $value) {
					if ($value !== "--" && $value !== "") {
						$val = preg_replace("#(')#", "\'", $value);
						$_data_str .= "`$column` = '$val' , ";
					}
				}
				$_data_str = preg_replace("#, $#", "", $_data_str);
				//IF NOTHING TO UPDATE
				if ($_data_str === "") {
					trigger_error("Nothing to update");
					return false;
				}
				//PREPARING, EXECUTING QUERY AND RETURNING BOOL DEPENDING ON RESULT
				$_query = "UPDATE users SET " . $_data_str . " WHERE username = '$id'";
				$_update_state = $this->DB->query($_query);
				if ($_update_state) {
					return true;
				}
				#trigger_error("Couldn't update retry");
				return false;
			}
			#trigger_error("User doesn't seem to exist for update");
			return false;
		}
		
	}