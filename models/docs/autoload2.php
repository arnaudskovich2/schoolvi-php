<?php
	
	function chargerClasse2($classe)
	{
		if(is_file("../../models/docs/" . ucfirst($classe) . '.php')){
			require_once "../../models/docs/" . ucfirst($classe) . '.php';
		}
	}
	
	spl_autoload_register('chargerClasse2');