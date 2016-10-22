<?php
$method = $_SERVER['REQUEST_METHOD'];
$route = $_SERVER['PATH_INFO'];
$successSounds = dir('sounds/success');
$failSounds = dir('sounds/failure');
$arrSuccessFiles = [];
$arrFailFiles = [];

while (false !== ($entry = $successSounds->read())) {
  if ($entry != "." && $entry != ".." && $entry != ".gitkeep") {
    $arrSuccessFiles [] = $successSounds->path ."/". $entry;
  }
}
$successSounds->close();

while (false !== ($entry = $failSounds->read())) {
  if ($entry != "." && $entry != ".." && $entry != ".gitkeep") {
    $arrFailFiles [] = $failSounds->path ."/". $entry;
  }
}
$failSounds->close();

switch ($route) {
  case '/random':
    $arrFiles = array_merge($arrFailFiles, $arrSuccessFiles);
    header("Location:  /". $arrFiles[array_rand($arrFiles)]);
    break;
  case '/success/random':
    header("Location: /". $arrSuccessFiles[array_rand($arrSuccessFiles)]);
    break;
  case '/failure/random':
    header("Location: /". $arrFailFiles[array_rand($arrFailFiles)]);
    break;
  default:
    echo "Please pass in a route";
    break;
}
