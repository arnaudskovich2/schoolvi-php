<?php
	/** @noinspection SqlResolve */
	
	/** @noinspection UnknownInspectionInspection */
	
	abstract class DocumentManager
	{
		protected PDO $DB;
		protected string $DOC_TYPE;
		protected string $INSTANCE_TYPE;
		
		/**
		 * DocumentManager constructor.
		 * @param PDO $db
		 */
		public function __construct (PDO $db)
		{
			$this->setDB($db);
		}
		
		/**
		 * Set the PDO object to use
		 */
		private function setDB (PDO $db) : void
		{
			if ($db->query("SELECT * FROM " . $this->getDocType())) {
				$this->DB = $db;
			} else {
				trigger_error("Require a valid PDO object to initialize " . $this->getDocType() . "Manager");
			}
		}
		
		/**
		 * Returns the value of the property DOC_TYPE
		 * @return string
		 */
		public function getDocType () : string
		{
			return $this->DOC_TYPE;
		}
		
		/**
		 * @param document The document instance to use in some cases
		 * @param array $filter The columns on which to filter result
		 * @param int $start The start option for LIMIT x,y x here
		 * @param int $n_results The number of results to return for LIMIT x,y y here
		 * @param bool $strict To use OR | AND in query for result
		 * @return bool|array
		 * @noinspection SqlResolve
		 */
		public function select (
			Document $document,
			array $filter = [],
			int $start = 0,
			int $n_results = 1,
			bool $strict = false) : bool|array
		{
			//VERIFIES IF IS THE GOOD MANAGER FOR DOC CLASS
			if (is_a($document, $this->INSTANCE_TYPE)) {
				//IF FILTER WAS GIVEN
				if (!empty($filter)) {
					//WRITE FILTER PART FOR THE QUERY
					$filter_str = " WHERE ";
					foreach ($filter as $value) {
						$method = 'get' . ucfirst(strtolower($value));
						if (method_exists($document, $method) && ($document->$method())) {
							//FILTER BASED ON STRICT SELECTION OR NOT
							$val = preg_replace("#(')#", "\'", $document->$method());
							
							$filter_str .= !($strict)
								? "`" . $value . "` REGEXP '" . $val . "', "
								: "`" . $value . "` REGEXP '" . $val . "' AND ";
						}
					}
					//CASE FILTER BUT NO VALUE RETRIEVED IN DOC PROPERTIES
					if ($filter_str === " WHERE ") {
						$filter_str = "";
					}
					$expected_number = " LIMIT " . $start . "," . ($n_results);
				} //CASE NO FILTER AND DOC id IS DEFINED
				else if (is_string($document->getId())) {
					$filter_str = " WHERE id = " . $document->getId();
					$expected_number = "";
				} //CASE NO FILTER AND NO id IN DOC INSTANCE
				else {
					$filter_str = "";
					$expected_number = " LIMIT " . $start . "," . ($n_results);
				}
				
				//REMOVING LAST <i>AND</i> OR <i>,</i>
				$filter_str = preg_replace("#(, ?|AND ?)$#", "", $filter_str);
				//FINAL QUERY STRING
				$query = "SELECT * FROM " . $this->getDocType() . $filter_str . " ORDER BY id DESC " . $expected_number;
				//TOTAL NUMBER OF RESULT FOUND FOR THE SEARCH QUERY STRING
				$total_found = "SELECT COUNT(DISTINCT `id`) FROM " . $this->getDocType() . $filter_str;
				//EXECUTING THE QUERIES
				$q_result = $this->DB->query($query);
				if (!$q_result) {
					//THROW ERROR IN CASE COULD NOT SELECT IN DB
					$to_return = false;
					#trigger_error((string) $q_result->errorInfo());
				} else {
					$to_return = $q_result->fetchAll(PDO::FETCH_ASSOC);
				}
				$total_results = $this->DB->query($total_found)->fetch(PDO::FETCH_NUM);
				//RETURN AN ARRAY CONTAINING THE RESULTS AND THE TOTAL NUMBER OF RESULTS
				return [$to_return, $total_results[0]];
			}
			trigger_error("Require a valid " . $this->getInstanceType() . " instance but another was given for select");
			return false;
		}
		
		/**
		 * Returns the value of property INSTANCE_TYPE
		 * @return string
		 */
		protected function getInstanceType () : string
		{
			return $this->INSTANCE_TYPE;
		}
		
		/**
		 * Add a document in the database
		 * @param document the document object to add
		 */
		abstract public function add (Document $document);
		
		/**
		 * Delete a document based on its id
		 * @param Document $document
		 * @return bool
		 */
		public function delete (Document $document) : bool
		{
			$id = $document->getId();
			$down = $document->getDownload();
			//VERIFY IF THE DOC INSTANCE id IS VALID AND DELETE THE DOC IN DB
			if (
				(is_string($id) || is_string($down)) &&
				(preg_match("#^(\d+)$#", $id) || preg_match("#^(.+)$#", $down))
			) {
				if (!empty($id) && is_string($id)) {
					$query = "DELETE FROM " . $this->getDocType() . " WHERE id = $id";
				} else {
					$query = "DELETE FROM " . $this->getDocType() . " WHERE download = '$down'";
				}
				$q_result = $this->DB->query($query);
				//IF A DOC WAS DELETED RETURN TRUE
				if ($q_result) {
					return true;
				}
			}
			#trigger_error("no valid id was specified in document instance so could not delete");
			return false;
		}
		
		/**
		 * Update an existing document in the database
		 * @param Document $document
		 * @return bool
		 */
		public function update (Document $document) : bool
		{
			$id = $document->getId();
			//VERIFY IF DOCUMENT EXISTS BEFORE STARTING UPDATE
			if ($this->exists($document, true)) {
				//SORTING COLUMN NAME BY ESCAPING CHARACTER
				$props = [
					"name",
					"description",
					"by",
					"type",
					"mat",
					"serie",
					"classe",
					"download",
					"f_name",
					"date"
				];
				//VAR THAT WILL CONTAIN THE PARAMS AND VALUES THAT WILL BE USED
				$to_update = "";
				
				//STARTING THE QUERY STRING CREATION
				
				//FOR WORDS THAT MUST BE ESCAPED WITH ``
				foreach ($props as $value) {
					$method = "get" . ucfirst($value);
					if (method_exists($document, $method) && preg_match("#^(.)+$#", $document->$method())) {
						$val = preg_replace("#(')#", "\'", $document->$method());
						$to_update .= "`$value` = '$val', ";
					}
				}
				
				//REMOVING LAST COMMA AT THE END OF THE CURRENT STRING
				$to_update = preg_replace("#(, ?)$#", "", $to_update);
				//FINAL QUERY STRING
				$query = 'UPDATE ' . $this->getDocType() . ' SET ' . $to_update . ' WHERE id = '.$id;
				//EXECUTING THE QUERY
				$q_result = $this->DB->query($query);
				return (bool) $q_result;
			}
			#trigger_error("Invalid id in document instance. Could not update");
			return false;
		}
		
		/**
		 * Verifies if document exists and return <strong>bool</strong>
		 * @param Document $document
		 * @param bool $_id_only whether to verify existence using Document <strong>id only</strong>
		 * if set to <strong>true</strong> and with all unique columns if <strong>false</strong>.<br>
		 * Default to <strong>false</strong>
		 * @param bool $no_id whether to verify without id
		 * @return bool
		 */
		protected function exists (Document $document, bool $_id_only = false, bool $no_id = false) : bool
		{
			//GETTING PROPERTIES VALUES TO USE FOR VERIFICATION
			$id = $document->getId();
			$download = $document->getDownload();
			$f_name = $document->getF_name();
			//ARRAY THAT WILL CONTAIN THE EXISTING RESULT BY PROPERTY
			$_exists = [];
			
			//VERIFY EXISTENCE USING ID
			$id_exists =
				$this->DB->query("SELECT * FROM " . $this->getDocType() . " WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
			//IF RESULT IS A ARRAY, THE DOC EXISTS AND THEN WE PUSH TRUE IN EXISTENCE ARRAY
			if (!$no_id && is_array($id_exists)) {
				$_exists[] = true;
			}
			/**
			 * VERIFY EXISTENCE USING DOWNLOAD AND F_NAME
			 * THIS HAPPENS ONLY WHEN $_id_only is set to false
			 */
			if (!$_id_only) {
				$download_exists =
					$this->DB->query("SELECT * FROM " . $this->getDocType() . " WHERE download = '$download'")->fetch(PDO::FETCH_ASSOC);
				$f_name_exists =
					$this->DB->query("SELECT * FROM " . $this->getDocType() . " WHERE f_name = '$f_name'")->fetch(PDO::FETCH_ASSOC);
				if (is_array($download_exists)) {
					$_exists[] = true;
				}
				if (is_array($f_name_exists)) {
					$_exists[] = true;
				}
			}
			//IF THERE WAS AT LEAST ONE QUERY THAT RETURN A RESULT, RETURN TRUE
			return is_int(array_search(true, $_exists, true));
		}
		
		/**
		 * Makes search for default on main page of each doc
		 * @param array $filter
		 * @param int $from
		 * @return array
		 */
		public function searchForDefault (array $filter = [], int $from = 0) : array
		{
			$_to_return = [];
			//IF THERE IS USER INFO AND IT WAS SENT FOR SEARCH
			$classe = $filter['classe'] ?? '';
			$serie = $filter['serie'] ?? '';
			if ($classe !== "" && $serie !== "") {
				$_query = "SELECT * FROM " . $this->getDocType() . " WHERE `classe` REGEXP '$classe' OR " .
					"`serie` REGEXP '$serie' ORDER BY id DESC LIMIT $from,25";
				$_count_query = "SELECT COUNT(DISTINCT `id`) from " . $this->getDocType() .
					"  WHERE `classe` REGEXP '$classe' OR `serie` REGEXP '$serie'";
				$_result = $this->DB->query($_query);
				if ($_result) {
					$_to_return[] = $_result->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$_to_return[] = [];
				}
				$_count = $this->DB->query($_count_query)->fetch(PDO::FETCH_NUM);
				$_to_return[] = $_count;
				return $_to_return;
			}
			//CASE NO USER INFO
			
			$_query = "SELECT * FROM " . $this->getDocType() . " ORDER BY id DESC LIMIT $from,25";
			$_count_query = "SELECT COUNT(DISTINCT `id`) FROM " . $this->getDocType();
			$_result = $this->DB->query($_query);
			if ($_result) {
				$_to_return[] = $_result->fetchAll(PDO::FETCH_ASSOC);
			} else {
				trigger_error("COULD NOT SEARCH FOR DEFAULT IN AnnaleManager 1");
			}
			$_count = $this->DB->query($_count_query)->fetch(PDO::FETCH_NUM);
			$_to_return[] = $_count;
			return $_to_return;
		}
		
		/**
		 * Search for docs in database using string and return result by 20
		 * @param string $query
		 * @param int $from
		 * @return bool|array
		 */
		public function searchWithString (string $query, int $from = 0) : bool|array
		{
			$_filter_array = [
				'name',
				'description',
				'mat',
				'classe',
				'type',
				'by',
			];
			$query = preg_replace("#(')#", "\'", $query);
			if ($query !== "") {
				$_filter_string = "";
				$_ins_name = $this->getInstanceType();
				$_instance = new $_ins_name([]);
				//IMPLODE QUERY STRING PARTS
				foreach ($_filter_array as $filter_key) {
					if (method_exists($_instance, "get" . ucfirst($filter_key))) {
						if ($_filter_string === "") {
							$_filter_string .= "`" . $filter_key . "` LIKE '%$query%'";
						} else {
							$_filter_string .= " OR `" . $filter_key . "` LIKE '%$query%'";
						}
					}
				}
				//FINALIZING QUERY STRING FOR SEARCH
				$_query = "SELECT *  FROM " . $this->getDocType() .
					" WHERE " . $_filter_string . " ORDER BY id DESC LIMIT $from,25";
				//QUERY STRING FOR COUNT TOTAL RESULT
				$count_q = "SELECT COUNT(DISTINCT id) FROM " . $this->getDocType() .
					" WHERE " . $_filter_string;
				$_result = $this->DB->query($_query);
				$_total = $this->DB->query($count_q)->fetch(PDO::FETCH_NUM);
				$_to_return = [];
				if ($_result) {
					$_to_return[] = $_result->fetchAll(PDO::FETCH_ASSOC);
				} else {
					$_to_return[] = $_result;
				}
				$_to_return[] = $_total;
				
				return $_to_return;
			}
			return false;
		}
			
			/**
			 * Search with specific values for each property
			 * @param Document $document
			 * @param string $order
			 * @param int $count
			 * @param int $from
			 * @return array
			 */
			public
			function searchWithSpecification (
				Document $document,
				string $order = "new",
				int $count = 10,
				int $from = 0) : array
			{
				$_valid_specification_methods = [
					'classe',
					'mat',
					'serie',
				];
				$_spec_string = " WHERE ";
				//IMPLODE SPECIFICATIONS FOR SEARCH
				foreach ($_valid_specification_methods as $spec) {
					$_method = 'get' . ucfirst($spec);
					if (!empty($document->$_method())) {
						$val = preg_replace("#(')#", "\'", $document->$_method());
						if ($_spec_string === " WHERE ") {
							$_spec_string .= $spec . " REGEXP '" . $val . "'";
						} else {
							$_spec_string .= " AND " . $spec . " REGEXP '" . $val . "'";
						}
					}
				}
				$_spec_string = ($_spec_string !== " WHERE ") ? $_spec_string : "";
				//ORDER STRING
				$_order_by = ($order === "new") ? " ORDER BY id DESC" : " ORDER BY id";
				//TRUNCATE RESULT STRING
				$_truncate_str = " LIMIT $from,$count";
				
				$_query = "SELECT * FROM " . $this->getDocType() . $_spec_string . $_order_by . $_truncate_str;
				$_count_q = "SELECT COUNT(DISTINCT id) FROM " . $this->getDocType() . $_spec_string;
				
				//EXECUTING QUERIES
				$_result = $this->DB->query($_query);
				$_total = $this->DB->query($_count_q);
				
				$_to_return = [];
				if ($_result) {
					$_to_return[] = $_result->fetchAll(PDO::FETCH_ASSOC);
					
				} else {
					$_to_return[] = $_result;
				}
				$_to_return[] = $_total->fetch(PDO::FETCH_NUM);
				
				return $_to_return;
			}
		}
