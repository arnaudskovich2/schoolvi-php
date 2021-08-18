<?php

class Epreuve extends Document
{

  protected string $type = "";

  public function getType(): string
  {
    return $this->type;
  }

  public function setType(String $new_value): void
  {
    $this->type = preg_match("#^[a-z0-9 -]+$#i", $new_value) ? $new_value : "Inconnu";
  }
}
