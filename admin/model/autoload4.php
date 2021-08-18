<?php
	function autoload4 (string $class)
	{
		if (!empty($class) && is_file("../model/" . $class . ".php")) {
			require_once "../model/" . $class . ".php";
		}
	}
	
	spl_autoload_register("autoload4");