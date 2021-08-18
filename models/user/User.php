<?php

  class User
  {
    public const _AUTH_CLASSES = ["2nde", "1ere", "Tle"];
    public const _AUTH_SERIES = ["A", "C", "D", "E", "F", "G"];
    public const _AUTH_STATES = ["Elève", "Enseignant"];
    protected $id;
    protected $name;
    protected $classe;
    protected $serie;
    protected $state;
    protected $school;
    protected $username;
    protected $password;
    protected $tel;
    protected $email;
    protected $reset;

    protected $_user = [
      'id'=>'--',
      'name'=>'--',
      'classe'=>'--',
      'serie'=>'--',
      'state'=>'--',
      'school'=>'--',
      'username'=>'--',
      'password'=>'--',
      'tel'=>'--',
      'email'=>'--',
      'reset'=>'--'
    ];

    /**
     * User constructor.
     * @param array $props
     */
    public function __construct (array $props)
    {
      $this->_hydrate($props);
    }

    /**
     * Sets properties values on user creation
     * @param array $props
     */
    private function _hydrate (array $props): void
    {
      foreach ($props as $prop => $value) {
        $method = "set" . ucfirst(strtolower($prop));
        if (!empty($value) && method_exists($this, $method)) {
          $this->$method($value);
          $this->_user[strtolower($prop)] = $value;
        }
      }
    }

    /**
     * Returns user id
     * @return mixed
     */
    public function getId (): mixed
    {
      return $this->id;
    }

    /**
     * Sets user id
     * @param mixed $id
     */
    protected function setId (mixed $id): void
    {
      if (preg_match("#^\d+$#", $id)) {
        $this->id = $id;
      }
    }

    /**
     * Returns user name
     * @return mixed
     */
    public function getName (): mixed
    {
      return $this->name;
    }

    /**
     * Sets user name
     * @param mixed $name
     */
    public function setName (mixed $name): void
    {
      if (preg_match("#^[a-z]{2,}(['-][a-z]{2,})?( [a-z]{2,}(['-][a-z]{2,})?)+$#i", $name)) {
        $this->name = $name;
      }
    }

    /**
     * Returns user classe
     * @return mixed
     */
    public function getClasse (): mixed
    {
      return $this->classe;
    }

    /**
     * Sets user classe
     * @param mixed $classe
     */
    public function setClasse (mixed $classe): void
    {
      if (in_array(ucfirst(strtolower($classe)), self::_AUTH_CLASSES, true)) {
        $this->classe = $classe;
      }
    }

    /**
     * Returns user serie
     * @return mixed
     */
    public function getSerie (): mixed
    {
      return $this->serie;
    }

    /**
     * Sets user serie
     * @param mixed $serie
     */
    public function setSerie (mixed $serie): void
    {
      if (in_array(strtoupper($serie), self::_AUTH_SERIES, true)) {
        $this->serie = $serie;
      }
    }

    /**
     * Returns user state
     * @return mixed
     */
    public function getState (): mixed
    {
      return $this->state;
    }

    /**
     * Sets user state
     * @param mixed $state
     */
    public function setState (mixed $state): void
    {
      if (in_array(ucfirst(strtolower($state)), self::_AUTH_STATES)) {
        $this->state = $state;
      }
    }

    /**
     * Returns user school
     * @return mixed
     */
    public function getSchool (): mixed
    {
      return $this->school;
    }

    /**
     * Sets user school
     * @param mixed $school
     */
    public function setSchool (mixed $school): void
    {
      if (preg_match("#^[a-z0-9 -]{3,30}$#i", $school)) {
        $this->school = $school;
      }
    }

    /**
     * Returns user username
     * @return mixed
     */
    public function getUsername (): mixed
    {
      return $this->username;
    }

    /**
     * Sets user username
     * @param mixed $username
     */
    public function setUsername (mixed $username): void
    {
      if (preg_match("#^[a-z0-9@_-]{6,30}$#", $username)) {
        $this->username = $username;
      }
    }

    /**
     * Returns user password
     * @return mixed
     */
    public function getPassword (): mixed
    {
      return $this->password;
    }

    /**
     * Sets user password
     * @param mixed $password
     */
    public function setPassword (mixed $password): void
    {
      if (preg_match("#^(.){6,40}$#",$password)) {
        $this->password = $password;
      }
    }

    /**
     * Returns user tel
     * @return mixed
     */
    public function getTel () :mixed
    {
      return $this->tel;
    }

    /**
     * Sets user tel
     * @param mixed $tel
     */
    public function setTel (mixed $tel): void
    {
      if(preg_match("#^\d{8,20}$#",$tel)){
        $this->tel = $tel;
      }
    }

    /**
     * Returns user email
     * @return mixed
     */
    public function getEmail () : mixed
    {
      return $this->email;
    }

    /**
     * Sets user email
     * @param mixed $email
     */
    public function setEmail (mixed $email): void
    {
      if(preg_match("#^[a-z0-9._-]{1,30}@[a-z]{2,20}((-\.)?[a-z]{2,30})?\.[a-z]{2,6}$#", $email)){
        $this->email = $email;
      }
    }

    /**
     * Returns user reset
     * @return mixed
     */
    public function getReset ():mixed
    {
      return $this->reset;
    }

    /**
     * @param mixed $reset
     */
    public function setReset (mixed $reset): void
    {
      if(preg_match("#^[a-z0-9]$#i", $reset)){
        $this->reset = $reset;
      }
    }

    /**
     * Returns all user properties and their value in an array
     * @return mixed
     */
    public function get_user ():array
    {
      return $this->_user;
    }
  }