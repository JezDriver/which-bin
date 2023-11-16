<?php 

$dates = json_decode(file_get_contents('dates-2023.json'), true);

date_default_timezone_set('Australia/Adelaide');
$today = date('d/m/Y');

$todaysBin = "Unknown";
foreach ($dates as $date) {
  if ($date['date'] === $today) {
    $todaysBin = $date['bin'];
  }
}

$emoji = "";
if($todaysBin === "Recycling") {
  $emoji = "🟡";
}
elseif($todaysBin === "Green") {
  $emoji = "🟢";
}

echo file_get_contents('https://trigger.macrodroid.com/bb1b07a4-fbec-4696-aac9-5f7bcefe9fb5/whichbin?whichBin=' . $todaysBin . '&binEmoji=' . urlencode($emoji));