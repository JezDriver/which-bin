<?php 
$scriptPath = realpath(dirname(__FILE__));

// Get Device ID from file (secrets)
$macrodroidDeviceId = file_get_contents($scriptPath . '/macrodroid/macrodroid-device-id.txt');

// Get dates data
$dates = json_decode(file_get_contents($scriptPath . '/data/dates-2023.json'), true);

// Get today's date
date_default_timezone_set('Australia/Adelaide');
$today = date('d/m/Y');

// Loop over dates, checking for today's bin
$todaysBin = "Unknown";
$dateFound = false;
foreach ($dates as $date) {
  if ($date['date'] === $today) {
    $todaysBin = $date['bin'];
    $dateFound = true;
  }
}

if($dateFound) {
  // If date was found, set the emoji icon
  if ($todaysBin === "Recycling" || $todaysBin === "Green") {
    // Colour code different bins
    $emoji = "";
    if($todaysBin === "Recycling") {
      $emoji = "🟡";
    }
    elseif($todaysBin === "Green") {
      $emoji = "🟢";
    }
  }
  else {
    // Fallback if bin isn't recycling/green (the data is mungy oops)
    $emoji = "❓";
  }
}
else {
  // Fallback for if the date wasn't found in the data
  $emoji = "❓";
}

// Trigger the webhook
// - passes device ID
// - sets whichBin macrodroid var to today's bin
// - sets binEmoji macrodroid var to corresponding emoji
echo file_get_contents('https://trigger.macrodroid.com/' . $macrodroidDeviceId . '/whichbin?whichBin=' . $todaysBin . '&binEmoji=' . urlencode($emoji));
