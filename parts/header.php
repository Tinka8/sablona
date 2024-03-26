<?php
/*
|--------------------------------------------------------------------------
| Theme switcher
|--------------------------------------------------------------------------
|
| This snippet is responsible for switching between themes.
|
*/

// Declare known themes
$themes = ["light", "dark"];

// Get theme from URL
$theme = $_GET["theme"] ?? "light";

// If theme is not in known themes, set it to light
if (!in_array($theme, $themes)) {
    $theme = "light";
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka</title>
    <?php
   include_once "functions.php";
   getCSS();
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="theme-<?php echo $theme ?>">

