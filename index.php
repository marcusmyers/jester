<?php
$method = $_SERVER['REQUEST_METHOD'];
$route = $_SERVER['REQUEST_URI'];
$successSounds = dir('sounds/success');
$failSounds = dir('sounds/failure');
$arrSuccessFiles = [];
$arrFailFiles = [];

if($method != "GET") {
  header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden", true, 404);
  echo json_encode(["status"=>"404 forbidden"]);
  exit();
}

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
  case '/random.mp3':
    $arrFiles = array_merge($arrFailFiles, $arrSuccessFiles);
    $file = $arrFiles[array_rand($arrFiles)];
    header("Content-Type: audio/mpeg");
    header("Content-Length: ". filesize($file));
    header('Content-Disposition: inline; filename="random.mp3";');
    header('Cache-Control: no-cache');
    readfile($file);
    break;
  case '/success/random.mp3':
    $file = $arrSuccessFiles[array_rand($arrSuccessFiles)];
    header("Content-Type: audio/mpeg");
    header("Content-Length: ". filesize($file));
    header('Content-Disposition: inline; filename="success.mp3";');
    readfile($file);
    break;
  case '/failure/random.mp3':
    $file = $arrFailFiles[array_rand($arrFailFiles)];
    header("Content-Type: audio/mpeg");
    header("Content-Length: ". filesize($file));
    header('Content-Disposition: inline; filename="failure.mp3";');
    readfile($file);
    break;
  default:
    header($_SERVER["SERVER_PROTOCOL"]." 404 Forbidden", true, 404);
    echo json_encode(["status"=>"404 not found", "route"=>$route]);
    break;
}
