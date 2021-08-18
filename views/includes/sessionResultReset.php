<?php
	$_SESSION['search'] = array();
	$_SESSION['search_specific'] = array();
	$_SESSION['pagination'] = [];
	unset(
	  $_SESSION['failed'],
    $_SESSION['success'],
    $_SESSION['delete_user_error'],
    $_SESSION['set_user_info_error'],
    $_SESSION['set_user_info_success'],
    $_SESSION['set_user_pass_error'],
    $_SESSION['set_user_pass_success']
  );
