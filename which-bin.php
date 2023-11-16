<?php 

$macrodroidDeviceId = file_get_contents('macrodroid/macrodroid-device-id.txt');
$dates = json_decode(file_get_contents('data/dates-2023.json'), true);

date_default_timezone_set('Australia/Adelaide');
$today = date('d/m/Y');

$todaysBin = "Unknown";
$dateFound = false;
foreach ($dates as $date) {
  if ($date['date'] === $today) {
    $todaysBin = $date['bin'];
    $dateFound = true;
  }
}

if($dateFound) {
  if ($todaysBin === "Recycling" || $todaysBin === "Green") {
    $emoji = "";
    if($todaysBin === "Recycling") {
      $emoji = "🟡";
    }
    elseif($todaysBin === "Green") {
      $emoji = "🟢";
    }
  }
  else {
    $emoji = "❓";
  }
}
else {
  $emoji = "❓";
}
echo file_get_contents('https://trigger.macrodroid.com/' . $macrodroidDeviceId . '/whichbin?whichBin=' . $todaysBin . '&binEmoji=' . urlencode($emoji));