<?php
	
	
	class Download
	{
		protected $user_id;
		protected string $downloads = "";
		
		public function __construct (array $data)
		{
			$this->hydrate($data);
		}
		
		protected function hydrate (array $data) : void
		{
			foreach ($data as $prop => $val) {
				$method = "set" . ucfirst(strtolower($prop));
				if (!empty($val) && method_exists($this, $method)) {
					$this->$method($val);
				}
			}
		}
		
		/**
		 * @return mixed
		 */
		public function getUser_id () : mixed
		{
			return $this->user_id;
		}
		
		/**
		 * @param mixed $user_id
		 */
		public function setUser_id (mixed $user_id) : void
		{
			if (preg_match("#^\d+$#", (string) $user_id)) {
				$this->user_id = (string) $user_id;
			}
		}
		
		/**
		 * Returns download array
		 * @return string[]
		 */
		public function getDownloads () : array
		{
			$_downloads_list = explode(";", $this->downloads);
			$_downloads_array = [];
			if (!empty($_downloads_list)) {
				foreach ($_downloads_list as $value) {
					$_parts = explode("=>", $value);
					if (isset($_parts[0], $_parts[1])) {
						$_downloads_array[$_parts[0]] = $_parts[1];
					}
				}
			}
			return $_downloads_array;
		}
		
		/**
		 * @param string $download
		 */
		public function setDownloads (string $download) : void
		{
				$this->downloads .= ';'.($download ?? '');
		}
		
		/**
		 * Return download string
		 * @return string
		 */
		public function getDownloadStr () : string
		{
			return $this->downloads;
		}
	}