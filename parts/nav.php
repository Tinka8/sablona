<?php
include_once "functions.php";

$menu = getMenuData("header");

$theme = $_GET["theme"] ?? "light";

?>
<header style="background-color: <?php echo $theme === "dark" ? "grey" : "white"; ?>" class="container main-header">
    <div  class="logo-holder">
        <a href="<?php echo $menu['home']['path']; ?>">
            <img alt="img" src="<?php echo $theme === "dark" ? "img/logo_white.png" : "img/logo.png" ?>" height="40">
        </a>
    </div>
    <nav class="main-nav">
        <ul class="main-menu" id="main-menu container">
            <li>
                <a href="<?php echo getCurrentLinkOtherTheme($theme) ?>">Zmena témy</a>
            </li>

            <?php printMenu($menu, $theme); ?>
        </ul>
        <a class="hamburger" id="hamburger">
            <i class="fa fa-bars"></i>
        </a>
    </nav>
</header>
