<?php
	
	class EpreuveManager extends DocumentManager
	{
		protected PDO $DB;
		protected string $DOC_TYPE = "epreuves";
		protected string $INSTANCE_TYPE = "Epreuve";
		
		public function add (Document $document) : bool
		{
			if (is_a($document, $this->INSTANCE_TYPE)) {
				$_1 = preg_replace("#(')#", "\'", $document->getName());
				$_2 = preg_replace("#(')#", "\'", $document->getDescription());
				$_3 = $document->getMat();
				$_4 = $document->getType();
				$_5 = $document->getSerie();
				$_6 = $document->getClasse();
				$_7 = $document->getDownload();
				$_8 = $document->getF_name();
				$_9 = $document->getBy();
				$_10 = $document->getDate();
				if (!$this->exists($document)) {
					$query = "INSERT INTO epreuves (`id`, `name`, `description`, `mat`, `type`, `serie`, `classe`, `download`, `f_name`, `by`, `date`)
                VALUES (NULL, '$_1', '$_2', '$_3', '$_4', '$_5', '$_6', '$_7', '$_8', '$_9', '$_10')";
					$q_result = $this->DB->query($query);
					if ($q_result) {
						return true;
					}
					return false;
				}
				#trigger_error("Le document existe déjà!");
				return false;
			}
			#trigger_error("Require an Epreuve instance but another was given for select");
			return false;
		}
	}
