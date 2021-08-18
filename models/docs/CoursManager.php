<?php
	
	/** @noinspection ALL */
	
	class CoursManager extends DocumentManager
	{
		protected PDO $DB;
		protected string $DOC_TYPE = "cours";
		protected string $INSTANCE_TYPE = "Cours";
		
		/**
		 * Add cours in the database
		 * @param cours the cours object to add
		 */
		public function add (Document $cours) : bool
		{
			if (is_a($cours, $this->INSTANCE_TYPE)) {
				$_1 = preg_replace("#(')#", "\'", $cours->getName());
				$_2 = preg_replace("#(')#", "\'", $cours->getDescription());
				$_3 = $cours->getMat();
				$_5 = $cours->getSerie();
				$_6 = $cours->getClasse();
				$_7 = $cours->getDownload();
				$_8 = $cours->getF_name();
				$_9 = $cours->getBy();
				$_10 = $cours->getDate();
				if (!$this->exists($cours)) {
					$query = "INSERT INTO `cours` (`id`, `name`, `description`, `mat`, `serie`, `classe`, `download`, `f_name`, `by`, `date`)
        VALUES (NULL, '$_1', '$_2', '$_3', '$_5', '$_6', '$_7', '$_8', '$_9', '$_10')";
					$q_result = $this->DB->query($query);
					if ($q_result) {
						return true;
					} else {
						return false;
					}
				} else {
					error_log("Le cours existe déjà!", 0);
					#trigger_error("Le cours existe déjà!");
					return false;
				}
			} else {
				error_log("Require a Cours instance but another was given for select", 0);
				#trigger_error("Require a Cours instance but another was given for select");
				return false;
			}
		}
	}
