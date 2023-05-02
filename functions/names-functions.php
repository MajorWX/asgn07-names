<?php

function load_full_names($fileName)
{
  $lineNumber = 0;

  // Load up the array
  $FH = fopen("$fileName", "r");
  $nextName = fgets($FH);

  while (!feof($FH)) {
    if ($lineNumber % 2 == 0) {
      $fullNames[] = trim(substr($nextName, 0, strpos($nextName, " --")));
    }

    $lineNumber++;
    $nextName = fgets($FH);
  }

  return $fullNames;
}

function load_first_names($fullNames)
{
  // Get all first names
  foreach ($fullNames as $fullName) {
    $startHere = strpos($fullName, ",") + 1;
    $firstNames[] = trim(substr($fullName, $startHere));
  }

  return $firstNames;
}

function load_last_names($fullNames)
{
  // Get all last names
  foreach ($fullNames as $fullName) {
    $stopHere = strpos($fullName, ",");
    $lastNames[] = substr($fullName, 0, $stopHere);
  }
  return $lastNames;
}

