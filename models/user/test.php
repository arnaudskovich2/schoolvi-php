<?php
  include "../../config/db.php";
  include "User.php";
  include "UserManager.php";
  global $_DB;
$m = new UserManager($_DB);
$u = new User(['']);

$e = $m->update($u, new User(['reset'=>'127404']));

if($e) {echo 'updated'; return;}
echo 'not updated';