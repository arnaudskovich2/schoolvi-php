<?php
	
	
	function chargerClasse3 ($classe)
	{
		if (is_file("../../models/user/" . ucfirst($classe) . '.php')) {
			require_once "../../models/user/" . ucfirst($classe) . '.php';
		}
	}
	
	spl_autoload_register('chargerClasse3');