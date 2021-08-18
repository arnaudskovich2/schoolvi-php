<?php
	
	class Admin
	{
		protected string $identifier = "";
		protected string $code = "";
		protected string $alias = "";
		
		public function __construct (array $data)
		{
			$this->hydrate($data);
		}
		
		private function hydrate (array $data) : void
		{
			foreach ($data as $prop => $value) {
				$method = "set" . ucfirst(strtolower($prop));
				if (is_string($value) && method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
		
		public function setIdentifier (string $identifier) : void
		{
			if (preg_match("#^[a-z0-9@_]{6,30}$#", $identifier)) {
				$this->identifier = $identifier;
			}
		}
		
		public function getCode () : string
		{
			return $this->code;
		}
		
		public function setCode (string $code) : void
		{
			if (preg_match("#^(.){6,}$#", $code)) {
				$this->code = $code;
			}
		}
		
		public function getAlias () : string
		{
			return $this->alias;
		}
		
		public function setAlias (string $alias) : void
		{
			if (preg_match("#^[a-z0-9]{4,8}$#", $alias)) {
				$this->alias = $alias;
			}
		}
		
		public function getIdentifier () : string
		{
			return $this->identifier;
		}
		
	}