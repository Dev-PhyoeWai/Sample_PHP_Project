<?php
    require("../functions.php");
    require("../database.php");
    const BASE_PATH = __DIR__ . '/../';
//    session_start();
    
    global $conn;
    
   
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $select_query = sprintf("SELECT title, notes.id as note_id, username, body, user_id " . 
            "FROM notes LEFT JOIN users ON notes.user_id = users.id WHERE notes.id = %d",
            mysqli_real_escape_string($conn, $id)
        );

        $results = mysqli_query($conn, $select_query);
        $count = mysqli_num_rows($results);
    } else {
        echo "Not found";
        return;
    }
    $user_name = $_GET['id'];
    if(isset($_POST['delete'])){
        
        $sql = "DELETE FROM notes WHERE id=$user_name";
        
        if($conn->query($sql) === TRUE) {
            header('Location: /sample-php-project/notes/notes.php');
        }else{
            echo "Error deleting record: " . $conn->error;
        }
    }
?>
<?php 
    view("header.view.php", [
        "title" => "Notes"
    ]);
?>
<?php view("nav.view.php");?>
<h1>Notes</h1>
<div>
    <?php if ($count > 0) : ?>
    <?php while($row = mysqli_fetch_assoc($results)) : ?>
<!--        --><?php
//
//            var_dump($row);
//            var_dump($_SESSION['user']['id']);
//            die;
//        ?>
        <h3><a href="note.php?id=<?=$row["note_id"]?>"><?= $row["title"] ?></a></h3>
        <p>Author - <?= $row["username"] ?? "Unknown" ?></p>
        <p>
            <?= htmlentities($row["body"]) ?>
        </p>
        <p>
            <?php if (isLoggedIn() && $_SESSION['user']['id'] === $row['user_id']) : ?>
                <a href="note-edit.php?id=<?= $row['note_id'] ?>">Edit<a/> |
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="submit" name="delete" value="DELETE"/>
                    </form>
               
            <?php endif; ?>
        </p>
    <?php endwhile; ?>
    <?php else: ?>
        <h4>404 not found.</h4>
    <?php endif; ?>
</div>
<?php view("footer.view.php");?>
