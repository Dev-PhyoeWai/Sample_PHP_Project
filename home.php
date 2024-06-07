<?php
    require("functions.php");
    require("database.php");
    const BASE_PATH = __DIR__ . '/';
?>

<?php
    //    session_start();
    view("header.view.php", [
    "title" => "Home"
]);?>
    <?php view("nav.view.php");?>
    <h1>Home</h1>
<!--    --><?php
//    var_dump($_SESSION['user']);
//    ?>
    <?php view("footer.view.php");?>
