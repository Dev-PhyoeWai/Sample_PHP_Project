<?php
    require ("functions.php");
    require ("database.php");
    const BASE_PATH = __DIR__ . '/';
?>

<?php view("header.view.php", [
    "title" => "About Us"
]);?>
<?php view("nav.view.php");?>
<h1>About Us</h1>
<?php view("footer.view.php");?>
