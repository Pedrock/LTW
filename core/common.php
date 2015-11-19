<?php
  include_once('core/config.php');
  session_start();
  header('Cache-control: private'); // IE 6 FIX

  if(isSet($_GET['lang']))
  {
    $lang = $_GET['lang'];

    $_SESSION['lang'] = $lang;

    setcookie('lang', $lang, time() + (3600 * 24 * 30));
  }
  else if(isSet($_SESSION['lang']))
  {
    $lang = $_SESSION['lang'];
  }
  else if(isSet($_COOKIE['lang']))
  {
    $lang = $_COOKIE['lang'];
  }
  else if (isSet($_SERVER['HTTP_ACCEPT_LANGUAGE']))
  {
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
  }
  else
  {
    $lang = 'en';
  }

  switch ($lang) {
    case 'pt':
    $lang_file = 'pt.php';
    break;

    default:
    $lang_file = 'en.php';
  }

  include_once('languages/'.$lang_file);
?>