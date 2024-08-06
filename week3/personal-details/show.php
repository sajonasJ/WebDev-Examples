<!DOCTYPE HTML>
<!-- Script to print PHP scripts.  Not for student inspection. -->
<html>
<head>
  <title>File source</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
/*
 * This script displays the contents of $file without
 * interpreting embedded PHP, HTML or JavaScript elements.
 * It only allows files in or below the current directory.
 */

  // Get the file name from the URL parameter 'file'
  $file = $_GET['file'];
  // echo "<b>$file:</b><br>\n"; // This line is commented out, it would display the file name

  // Check if a file name was given
  if ( empty($file) || $file == "" ) {
      // If no file name is provided, display an error message and exit
      echo "Missing filename.<br>\n";
      exit;
  }

  // Check if the file path is allowed
  if ( strncmp($file, "/", 1) == 0 || strstr($file, "../") ) {
      // If the file path starts with '/' or contains '../', it's not allowed
      echo "File name is not allowed: $file.<br>\n";
      exit;
  }

  // Sanitize the file name (unnecessary here?)
  // EscapeShellCmd is used to escape any characters in the file name that might be used to execute shell commands
  $file = EscapeShellCmd(substr($file, 0, 40));

  // Check if the file exists and is a regular file
  if ( !file_exists($file) || !is_file($file) ) {
      // If the file does not exist or is not a regular file, display an error message and exit
      echo "File not found or not printable: $file.<br>\n";
      exit;
  }

  // Attempt to open the file for reading
  $fp = fopen($file, "r");
  if ( $fp == FALSE ) {
      // If the file cannot be opened, display an error message and exit
      echo "Couldn't open file: $file.<br>\n";
      exit;
  }

  // Print lines of the file
  echo "<pre>\n"; // Start preformatted text block
  while ( !feof($fp) ) {
      // Read and print each line of the file, converting special characters to HTML entities
      echo htmlspecialchars(fgets($fp,4096));
  }
  fclose($fp); // Close the file
  echo "</pre>\n"; // End preformatted text block
?>
</body>
</html>