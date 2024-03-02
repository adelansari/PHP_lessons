<?php
    // if the form has been sent, add the new verse to the file
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add-to-poem'])) {
            // Add the new verse to the file
            $newVerse = $_POST['new-verse'] . "\n";
            file_put_contents('poem.txt', $newVerse, FILE_APPEND);
        }
    }
    $poem = '';
    if (file_exists('poem.txt')) {
        $poem = file_get_contents('poem.txt');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write a poem</title>
</head>
<body>
    <h3>Write a poem</h3>

    <div id="poem">
        <?php
            // read the poem from file and display here
            echo nl2br($poem);
        ?>
    </div>

    <form action="write_poem.php" method="post">
        <textarea name="new-verse" rows="3" cols="50"></textarea><br>
        <input type="submit" name="add-to-poem" value="Add verse">
    </form>
    
</body>
</html>