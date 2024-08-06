<?php
/*
 * Script to print the prime factors of a single positive integer
 * sent from a form.
 * BAD STYLE: Does not use templates.
 */
include "includes/defs.php";

# Initialize variables
$number = "";
$error = "";
$factors = "";

# Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['number'])) {
  # Set $number to the value entered in the form.
  $number = $_GET['number'];

  # Validate the input
  if (empty($number)) {
    $error = "Error: Missing value";
  } else if (!is_numeric($number)) {
    $error = "Error: Nonnumeric value: $number";
  } else if ($number < 2 || $number != strval(intval($number))) {
    $error = "Error: Invalid number: $number";
  } else {
    # Set $factors to the array of factors of $number.
    $factors = factors($number);
    # Convert $factors to a single dot-separated string of numbers.
    $factors = join(" . ", $factors);
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Factors</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="styles/wp.css">
</head>

<body>
  <h1>Factorisation</h1>

  <?php echo empty($error) ? "$number = $factors" : $error; ?>

  <form method="get" action="factorise.php">
    <p>Number to factorise: <input type="text" name="number" value="<?= $number ?>">
    <p><input type="submit" value="Factorise it!">
  </form>
  <hr>
  <p>
    Sources:
    <a href="show.php?file=factorise.php">factorise.php</a>
    <a href="show.php?file=includes/defs.php">includes/defs.php</a>
  </p>
</body>

</html>