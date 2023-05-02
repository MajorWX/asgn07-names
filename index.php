<?php
include 'functions/utility-functions.php';
include 'functions/names-functions.php';

$fileName = 'names-short-list.txt';
$fullNames = load_full_names($fileName);

$firstNames = load_first_names($fullNames);
$lastNames = load_last_names($fullNames);


// Get valid names
for($i = 0; $i < sizeof($fullNames); $i++) {
    // jam the first and last name toghether without a comma, then test for alpha-only characters
    if(ctype_alpha($lastNames[$i].$firstNames[$i])) {
        $validFirstNames[$i] = $firstNames[$i];
        $validLastNames[$i] = $lastNames[$i];
        $validFullNames[$i] = $validLastNames[$i] . ", " . $validFirstNames[$i];
    }
}



// ~~~~~~~~~~~~ Display results ~~~~~~~~~~~~ //

echo '<h1>Names - Results</h1>';

echo '<h2>All Names</h2>';
echo "<p>There are " . sizeof($fullNames) . " total names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($fullNames as $fullName) {
        echo "<li>$fullName</li>";
    }
echo "</ul>";

echo '<h2>All Valid Names</h2>';
echo "<p>There are " . sizeof($validFullNames) . " valid names</p>";
echo '<ul style="list-style-type:none">';    
    foreach($validFullNames as $validFullName) {
        echo "<li>$validFullName</li>";
    }
echo "</ul>";

echo '<h2>Unique Full Names</h2>';
$uniqueValidNames = (array_unique($validFullNames));
echo ("<p>There are " . sizeof($uniqueValidNames) . " Unique full names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueValidNames as $uniqueValidName) {
        echo "<li>$uniqueValidName</li>";
    }
echo "</ul>";

echo '<h2>Unique Last Names</h2>';
$uniqueValidLastNames = (array_unique($validLastNames));
echo ("<p>There are " . sizeof($uniqueValidLastNames) . " Unique last names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueValidLastNames as $uniqueValidName) {
        echo "<li>$uniqueValidName</li>";
    }
echo "</ul>";

echo '<h2>Unique First Names</h2>';
$uniqueValidFirstNames = (array_unique($validFirstNames));
echo ("<p>There are " . sizeof($uniqueValidFirstNames) . " Unique first names</p>");
echo '<ul style="list-style-type:none">';    
    foreach($uniqueValidFirstNames as $uniqueValidName) {
        echo "<li>$uniqueValidName</li>";
    }
echo "</ul>";

//============ Most common last names ============ 
// I used the valid last names array, but I might want to switch to the last names of the unique full names

echo '<h2>Most Common Last Names</h2>';
//Make a blank associative array
$lastNameCounts = array();
//Run line by line through the list of valid last names
foreach($validLastNames as $validLastName) {
  //If the last name already exists in our counting array
  if(array_key_exists($validLastName, $lastNameCounts)) {
    //Increase the value stored at the key with that last name by one.
    $lastNameCounts[$validLastName] += 1;
  } //If the last name doesn't yet exist in our counting array
  else {
    //Add that name to the list and give it a count of 1
    $lastNameCounts += array($validLastName => 1);
  }
}

//Now we have an array with every last name and a count of each time it appears

//Make a value for the highest count
$highestCount = 0;
//Make an empty list that contains all last names with that count
$lastNamesWithHighest = array();

//Run line by line through the count array
foreach($lastNameCounts as $countLastName => $countLastNameValue) {
  //Check to see if it's higher than the current highest amount
  if($countLastNameValue > $highestCount) {
    //If it is, set the new highestCount
    $highestCount = $countLastNameValue;
    //Empty out the list that had the highest
    $lastNamesWithHighest = array();
    //Add the current last name to the list
    $lastNamesWithHighest[] = $countLastName;
  } //If the count ties but doesn't beat the current highest count
  elseif($countLastNameValue == $highestCount) {
    //Add the current last name to the list
    $lastNamesWithHighest[] = $countLastName;
  }
}

//Check to see if all the names are unique.
if($highestCount == 1) {
  echo '<p>All the names were unique, making them all the most common!</p>';
} //Check to see if there's only one name with the highest count
elseif(sizeof($lastNamesWithHighest) == 1) {
  echo '<p>The last name ' . $lastNamesWithHighest[0] . ' appeared the most with a total count of ' . $highestCount . '.</p>';
} //If there are multiple last names with the highest count
else {
  echo '<p>The last names';
  foreach($lastNamesWithHighest as $eachName) {
    echo '' . $eachName . ', ';
  }
  echo 'all had the count of ' . $highestCount . '.</p>';
}

//============ Most common first names ============ 
// I used the valid first names array, but I might want to switch to the first names of the unique full names

echo '<h2>Most Common First Names</h2>';
//Make a blank associative array
$firstNameCounts = array();
//Run line by line through the list of valid first names
foreach($validFirstNames as $validFirstName) {
  //If the first name already exists in our counting array
  if(array_key_exists($validFirstName, $firstNameCounts)) {
    //Increase the value stored at the key with that first name by one.
    $firstNameCounts[$validFirstName] += 1;
  } //If the first name doesn't yet exist in our counting array
  else {
    //Add that name to the list and give it a count of 1
    $firstNameCounts += array($validFirstName => 1);
  }
}

//Now we have an array with every first name and a count of each time it appears

//Make a value for the highest count
$highestCount = 0;
//Make an empty list that contains all first names with that count
$firstNamesWithHighest = array();

//Run line by line through the count array
foreach($firstNameCounts as $countFirstName => $countFirstNameValue) {
  //Check to see if it's higher than the current highest amount
  if($countFirstNameValue > $highestCount) {
    //If it is, set the new highestCount
    $highestCount = $countFirstNameValue;
    //Empty out the list that had the highest
    $firstNamesWithHighest = array();
    //Add the current first name to the list
    $firstNamesWithHighest[] = $countFirstName;
  } //If the count ties but doesn't beat the current highest count
  elseif($countFirstNameValue == $highestCount) {
    //Add the current first name to the list
    $firstNamesWithHighest[] = $countFirstName;
  }
}

//Check to see if all the names are unique.
if($highestCount == 1) {
  echo '<p>All the names were unique, making them all the most common!</p>';
} //Check to see if there's only one name with the highest count
elseif(sizeof($firstNamesWithHighest) == 1) {
  echo '<p>The first name ' . $firstNamesWithHighest[0] . ' appeared the most with a total count of ' . $highestCount . '.</p>';
} //If there are multiple first names with the highest count
else {
  echo '<p>The first names';
  foreach($firstNamesWithHighest as $eachName) {
    echo '' . $eachName . ', ';
  }
  echo 'all had the count of ' . $highestCount . '.</p>';
}


?>








