<?php
	
	class AdminManager extends Admin
	{
		protected PDO $DB;
		
		public function __construct (PDO $db)
		{
			$this->hydrate($db);
		}
		
		private function hydrate (PDO $data) : void
		{
			$_test = "SELECT id FROM admin LIMIT 0,1";
			$_test_res = $data->query($_test);
			if ($_test_res !== false) {
				$this->DB = $data;
			} else {
				trigger_error("Require a valid PDO to initialize AdminManager");
			}
		}
		
		public function exists (Admin $admin) : bool
		{
			$id = $admin->getIdentifier();
			if (!empty($id)) {
				$_query = "SELECT COUNT(DISTINCT id) FROM admin WHERE identifier = '$id'";
				$_res = $this->DB->query($_query)->fetch()[0] ?? false;
				if ($_res !== false && (int) $_res === 1) {
					return true;
				}
			}
			return false;
		}
		
		public function select (Admin $admin) : array
		{
			$_id = $admin->getIdentifier();
			if (!empty($_id) && $this->exists($admin)) {
				$_query = "SELECT * FROM admin WHERE identifier = '$_id'";
				$_res = $this->DB->query($_query);
				if (!($_res === false)) {
					return $_res->fetchAll(PDO::FETCH_ASSOC)[0];
				}
			}
			return [];
		}
		
		public function update (Admin $old, Admin $new) : bool
		{
			$_id = $old->getIdentifier();
			if (!empty($_id) && $this->exists($old)) {
				function escape (string $str) : string
				{
					return preg_replace("#(')#", "\'", $str);
				}
				
				$_props = (!empty($new->getIdentifier())) ? "`identifier` = '" . escape($new->getIdentifier()) . "'" : "";
				$_props .= (!empty($new->getAlias())) ? ", `alias` = '" . escape($new->getAlias()) . "'" : "";
				$_props .= (!empty($new->getCode())) ? ", `code` = '" . escape($new->getCode()) . "'" : "";
				$_props = preg_replace("#^(, ?)#", "", $_props);
				if ($_props !== "") {
					$_q = 'UPDATE admin SET ' . $_props . ' WHERE `identifier` = \''.$_id.'\'';
					$res = $this->DB->exec($_q);
					return !($res === false);
				}
			}
			return false;
		}
		
	}