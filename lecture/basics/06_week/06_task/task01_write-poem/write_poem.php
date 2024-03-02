<?php
    // if the form has been sent, add the new verse to the file
    if (isset($_POST['add-to-poem'])) {
        $newVerse = $_POST['new-verse'];
        $file = fopen('poem.txt', 'a') or die("Failed to open the file");;
        fwrite($file, $newVerse . "\n");
        fclose($file);
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
            $file = fopen('poem.txt', 'r');
            while (!feof($file)) {
                $verse = fgets($file);
                echo $verse . "<br>";
            }
            fclose($file);
        ?>
    </div>

    <form action="write_poem.php" method="post">
        <textarea name="new-verse" rows="3" cols="50"></textarea><br>
        <input type="submit" name="add-to-poem" value="Add verse">
    </form>
    
</body>
</html>