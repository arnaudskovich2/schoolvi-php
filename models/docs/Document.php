<?php /** @noinspection ALL */
  
  abstract class Document
{
  protected const _MATS = array(
    "FR", "ANG", "RUSSE", "ALL", "ECM", "HG", "PHILO",
    "MATHS", "SP", "SVT", "MUS", "EM", "AGRI", "EPS", "AUTRE"
  );
  protected const _SERIES = array("A", "C", "D", "E", "F", "G");
  protected const _CLASSES = array("Tle", "1ere", "2nde");
  protected $id;
  protected $name;
  protected $description;
  protected $mat;
  protected $serie;
  protected $classe;
  protected $download;
  protected $f_name;
  protected $by;
  protected $date;
  
  /**
   * Document constructor.
   * @param array $data
   */
  public function __construct(array $data)
  {
    $this->_hydrate($data);
  }
  
  /**
   * Initialize the object by passing setting its properties
   * @param array $data
   */
  private function _hydrate(array $data) : void
  {
    foreach ($data as $key => $value) {
      $setter = 'set' . ucfirst($key);
      if (method_exists($this, $setter)) {
        $this->$setter($value);
      }
    }
  }

  //GETTERS && SETTERS
  /**
   * Returns the value of the property id
   * @return string|null
   */
  public function getId(): ?string
  {
    return $this->id;
  }
  
  /**
   * Sets the property id of the doc
   * @param String $new_value
   */
  protected function setId(String $new_value):void
  {
    if (preg_match("#^[0-9]+$#", $new_value)) {
      $this->id = $new_value;
    }
  }
  
  /**
   * Returns the value of the property name
   * @return string
   */
  public function getName():?string
  {
    return $this->name;
  }
  
  /**
   * Sets the property name of the doc
   * @param String $new_value
   */
  public function setName(String $new_value):void
  {
    if (preg_match("#^[a-z0-9 _'-]+$#i", $new_value)) {
      $this->name = $new_value;
    }
  }
  
  public function getDescription():?string
  {
    return $this->description;
  }
  
  /**
   * Sets the property description
   * @param String $new_value
   */
  public function setDescription(String $new_value): void
  {
    if (preg_match("#^(.)+$#", $new_value)) {
      $this->description = $new_value;
    } else {
      $this->description = "Aucune description";
    }
  }
  
  /**
   * Returns the value of the property mat
   * @return string
   */
  public function getMat(): ?string
  {
    return $this->mat;
  }
  
  /**
   * Sets the property mat of the doc
   * @param String $new_value
   */
  public function setMat(String $new_value): void
  {
    $list_of_mats = explode('-', $new_value);
    $respect_rules = [];
    foreach ($list_of_mats as $value) {
      if (is_int(array_search(strtoupper($value), self::_MATS))) {
        $respect_rules[] = $value;
      }
    }
    $this->mat = strtoupper(implode('-', $respect_rules));
  }
  
  /**
   * Returns the value of the property get
   * @return string
   */
  public function getSerie(): ?string
  {
    return $this->serie;
  }
  
  
  /**
   * Sets the property serie of the doc
   * @param String $new_value
   */
  public function setSerie(String $new_value): void
  {
    $list_of_series = explode('-', $new_value);
    $respect_rules = [];
    foreach ($list_of_series as $value) {
      if (is_int(array_search(strtoupper($value), self::_SERIES))) {
        $respect_rules[] = $value;
      }
    }
    $this->serie = strtoupper(implode('-', $respect_rules));
  }
  
  /**
   * Returns the value of the property classe
   * @return string
   */
  public function getClasse(): ?string
  {
    return $this->classe;
  }
  
  /**
   * Sets the property classe of the doc
   * @param String $new_value
   */
  public function setClasse(String $new_value): void
  {
    $list_of_classes = explode('-', $new_value);
    $respect_rules = [];
    foreach ($list_of_classes as $value) {
      if (is_int(array_search(ucfirst(strtolower($value)), self::_CLASSES))) {
        $respect_rules[] = $value;
      }
    }
    $this->classe = strtoupper(implode("-", $respect_rules));
  }
  
  /**
   * Returns the value of the property download
   * @return string
   */
  public function getDownload(): ?string
  {
    return $this->download;
  }
  
  /**
   * Sets the property download of the doc
   * @param String $new_value
   */
  protected function setDownload(String $new_value): void
  {
    if (preg_match("#^(.)+$#", $new_value)) {
      $this->download = $new_value;
    }
  }
  
  /**
   * Returns the value of the property f_name
   * @return string
   */
  public function getF_name(): ?string
  {
    return $this->f_name;
  }
  
  /**
   * Sets the property f_name of the doc
   * @param String $new_value
   */
  public function setF_name(String $new_value): void
  {
    if (preg_match("#^(.)+$#", $new_value)) {
      $this->f_name = $new_value;
    }
  }
  
  /**
   * Returns the value of the property by
   * @return string
   */
  public function getBy(): ?string
  {
    return $this->by;
  }

  /**
   * Sets the property by of the doc
   * @param String $new_value
   */
  public function setBy(String $new_value): void
  {
    if (preg_match("#^[a-z0-9@_ -]+$#i", $new_value)) {
      $this->by = $new_value;
    }else{
      trigger_error("Invalid value given for property `by`");
    }
  }
  
  /**
   * Returns the value of the property date
   * @return string
   */
  public function getDate(): ?string
  {
    return $this->date;
  }
  
  /**
   * Sets the property date of the doc
   * @param String $new_value
   */
  public function setDate(String $new_value): void
  {
    if (preg_match("#^\d{4}-\d{2}-\d{2}$#", $new_value)) {
      $this->date = $new_value;
    }
  }
  
}
