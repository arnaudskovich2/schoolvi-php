<?php /** @noinspection PhpMissingFieldTypeInspection */
	
	class AnnaleManager extends DocumentManager
	{
		protected PDO $DB;
		protected string $DOC_TYPE = "annales";
		protected string $INSTANCE_TYPE = "Annale";
		
		/**
		 * Add cours in the database
		 * @param cours the cours object to add
		 * @return bool
		 * @noinspection PhpParameterNameChangedDuringInheritanceInspection
		 */
		public function add (Document $annale) : bool
		{
			if (is_a($annale, $this->INSTANCE_TYPE)) {
				$_1 = preg_replace("#(')#", "\'", $annale->getName());
				$_2 = preg_replace("#(')#", "\'", $annale->getDescription());
				$_3 = $annale->getMat();
				$_5 = $annale->getSerie();
				$_6 = $annale->getClasse();
				$_7 = $annale->getDownload();
				$_8 = $annale->getF_name();
				$_9 = $annale->getBy();
				$_10 = $annale->getDate();
				if (!$this->exists($annale)) {
					$query = "INSERT INTO `annales` (`id`, `name`, `description`, `mat`, `serie`, `classe`, `download`, `f_name`, `by`, `date`)
        VALUES (NULL, '$_1', '$_2', '$_3', '$_5', '$_6', '$_7', '$_8', '$_9', '$_10')";
					$q_result = $this->DB->query($query);
					if ($q_result) {
						return true;
					}
					return false;
				}
				#trigger_error("L'annale existe déjà!");
				return false;
			}
			#trigger_error("Require an Annale instance but another was given for select");
			return false;
		}
		
	}
