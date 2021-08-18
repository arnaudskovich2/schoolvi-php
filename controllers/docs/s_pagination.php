<?php
  session_start();
  require_once "../../models/docs/autoload2.php";
  require_once "../../config/db.php";
  global $_DB;

  //INITIALIZING VARIABLES FOR SEARCH AFTER VERIFICATION
  $classe = $_GET['classe'] ?? '';
  $mat = $_GET['mat'] ?? '';
  $serie = $_GET['serie'] ?? '';
  $sort = (isset($_GET['sort']) && $_GET['sort'] === "old") ? 'old' : 'new';
  $count = (isset($_GET['count']) && preg_match("#^\d+$#", $_GET['count']) && (int)$_GET['count'] >= 5)
    ? (int)($_GET['count']) : 10;
  $page = (isset($_GET['page']) && preg_match("#^\d+$#", $_GET['page']))
    ? (int)$_GET['page'] : 0;
  $current = (string)$_SESSION['current'];

  //MAIN DOC PAGES NAMES FOR VERIFICATION
  $_AUTH_FROM = ["epreuves", "annales", "cours"];

  //RESUMING SPECS IN AN ARRAY
  $props = [
    'classe' => $classe,
    'mat' => $mat,
    'serie' => $serie
  ];

  //INITIALIZING MANAGERS FOR EACH TYPE OF DOC
  $_MANAGERS_ARRAY = [
    "epreuves" => new EpreuveManager($_DB),
    "annales" => new AnnaleManager($_DB),
    "cours" => new CoursManager($_DB)
  ];
  //DOING SAME FOR INSTANCES
  $_INSTANCES_ARRAY = [
    'annales' => new Annale($props),
    'epreuves' => new Epreuve($props),
    'cours' => new Cours($props)
  ];

  //RESETTING CURRENT RESULTS
  $_SESSION['search'] = $_SESSION['search_specific'] = $_SESSION['pagination'] = [];

  //CASE COMING FROM A DOC TYPE PAGE
  if (isset($current) && in_array($current, $_AUTH_FROM, true)) {
    //SELECTING REQUIRED INSTANCE AND IT'S MANAGER
    $_INSTANCE = $_INSTANCES_ARRAY[$current];
    $_C_MANAGER = $_MANAGERS_ARRAY[$current];
    $from = $page * $count;
    //PERFORMING THE SEARCH AND COUNTING TOTAL
    $_result = $_C_MANAGER->searchWithSpecification($_INSTANCE, $sort, $count, $from);
    $_total = (int)$_result[1][0];
    $_SESSION['search_specific'][$current] = $_result[0];
    //IF NUMBER OF RESULTS IS GREATER THAN THE COUNT VAR WE CREATE PAGINATION LINKS
    if (ceil($_total / $count) > 1) {
      for ($i = 0; $i < ceil($_total / $count); $i++) {
        $_SESSION['pagination'][] = "/controllers/docs/s_pagination.php?mat=" . $mat
          . "&classe=$classe&serie=$serie&count=$count&sort=$sort&page=" . $i;
      }
    }
    //CREATING REDIRECTING URL AND PERFORM A REDIRECTION
    $_next = "Location:/views/" . $current . "/index.php?mat=" . $mat
      . "&classe=$classe&serie=$serie&count=$count&sort=$sort&page=$page";
    header($_next);
    return;
  }

  //NOT IN LOGIC
  header("Location: /views/notFound.php");
  return;

