<?php
  $current = $_SESSION['current'];
	//IF REFRESHING AFTER A SPECIFIC SEARCH
	if(isset($_GET['page'], $_GET['classe'], $_GET['serie'], $_GET['mat'],$_GET['count']) &&
			!isset($_SESSION['search_specific'][$_SESSION['current']]) &&
			!isset($_SESSION['search'][$_SESSION['current']])
	){
		$page = $_GET['page'] ?? '0';
		$classe =  $_GET['classe'] ?? '';
		$serie = $_GET['serie'] ?? '';
		$mat = $_GET['mat'] ?? '';
		$count = $_GET['count'];
		$sort = $_GET['sort'];
		$_str = "mat=".$mat."&classe=$classe&serie=$serie&sort=$sort&count=$count&page=".$page;
		header("Location:/controllers/docs/s_pagination.php?".$_str);
		return;
	}
	//WHEN THERE IS A SPECIFIC SEARCH RESULT
	if (
		isset($_SESSION['search_specific'][$current]) &&
		is_array($_SESSION['search_specific'][$current])
	) {
		$_SESSION['search'] = [];
		$_SESSION['search'][$current] = $_SESSION['search_specific'][$current];
	}
	//REFRESHING PAGE AFTER A SEARCH RESULT
	if(isset($_GET['page']) && !isset($_SESSION['search'][$current])){
		header('Location:/controllers/docs/pagination.php?page='.$_GET['page']);
		return;
	}
	//DEFAULT LOADING
	if (
		!isset($_SESSION['search'][$current]) && !isset($_GET['page'])
	) {
	  header('Location:/controllers/docs/search.php');
	  return;
	}