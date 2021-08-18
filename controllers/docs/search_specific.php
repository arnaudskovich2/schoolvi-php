<?php
  session_start();
  require_once "../../models/docs/autoload2.php";
  require_once "../../config/db.php";
  global $_DB;
  //VERIFICATION CONSTANTS
  $classe = $_POST['s_classe'] ?? '';
  $mat = $_POST['s_mat'] ?? '';
  $serie = $_POST['s_serie'] ?? '';
  $sort = (isset($_POST['s_sort']) && $_POST['s_sort'] === "old") ? 'old' : 'new';
  $count = (isset($_POST['s_count']) && preg_match("#^\d+$#", $_POST['s_count']) && (int)$_POST['s_count'] >= 5)
    ? (int)$_POST['s_count']
    : 10;

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
  //CLEARING SESSION VARS
  $_SESSION['search_specific'] = $_SESSION['search'] = $_SESSION['pagination'] = [];

  //CASE COMING FROM A DOC TYPE PAGE
  if (isset($current) && in_array($current, $_AUTH_FROM, true)) {
    //SELECTING REQUIRED INSTANCE AND IT'S MANAGER
    $_INSTANCE = $_INSTANCES_ARRAY[$current];
    $_MANAGER = $_MANAGERS_ARRAY[$current];
    //PERFORMING THE SEARCH AND COUNTING TOTAL
    $_result = $_MANAGER->searchWithSpecification($_INSTANCE, $sort, $count);
    $_total = (int)$_result[1][0];
    $_SESSION['search_specific'][$current] = $_result[0];
    //IF NUMBER OF RESULTS IS GREATER THAN THE COUNT VAR WE CREATE PAGINATION LINKS
    if (ceil($_total / $count) > 1) {
      for ($i = 0; $i < ceil($_total / $count); $i++) {
        $_SESSION['pagination'][] = "/controllers/docs/s_pagination.php?mat=" . $mat
          . "&classe=$classe&serie=$serie&count=$count&sort=$sort&page=" . $i;
      }
    }
    //REDIRECTING
    $next = "Location:/views/" . $current . "/index.php?mat=" . $mat
      . "&classe=$classe&serie=$serie&count=$count&sort=$sort&page=0";
    header($next);
    return;
  }

  //NOT IN LOGIC
  header("Location: /views/notFound.php");
  return;
