<?php
  require_once "../../config/db.php";
  require_once "../../models/user/autoload3.php";
  global $_DB;
  $_MANAGER = new UserManager($_DB);
  if(isset($_SESSION['isConnected'])){
    $_INSTANCE = new User($_SESSION['user'] ?? []);
    if($_MANAGER->exists($_INSTANCE)){
      return;
    }
  }
  unset($_SESSION['user'], $_SESSION['isConnected']);
  return;