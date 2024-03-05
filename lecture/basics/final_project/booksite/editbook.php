<?php
session_start();

// If the user is not logged in, redirect them back to login.php.
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: login.php');
    exit;
}

$books = json_decode(file_get_contents('books.json'), true);
$bookToEdit = null;

if (isset($_GET['bookid'])) {
    // Pre-fill the form with the existing book data
    $bookid = $_GET['bookid'];

    foreach ($books as $book) {
        if ($book['id'] == $bookid) {
            $bookToEdit = $book;
            break;
        }
    }
}

if ($bookToEdit !== null) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Favorite Books</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="booksite.css">
    </head>

    <body>
        <div id="container">
            <header>
                <h1>Your Favorite Books</h1>
            </header>
            <nav id="main-navi">
                <ul>
                    <li><a href="admin.php">Admin Home</a></li>
                    <li><a href="addbook.php">Add a New Book</a></li>
                    <li><a href="login.php?logout">Log Out</a></li>
                </ul>
            </nav>
            <main>
                <h2>Edit Book</h2>
                <form action="admin.php" method="post">
                    <p>
                        <label for="bookid">ID:</label>
                        <input type="number" id="bookid" name="bookid" value="<?php echo $bookToEdit['id']; ?>" readonly>
                    </p>
                    <p>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo $bookToEdit['title']; ?>">
                    </p>
                    <p>
                        <label for="author">Author:</label>
                        <input type="text" id="author" name="author" value="<?php echo $bookToEdit['author']; ?>">
                    </p>
                    <p>
                        <label for="year">Year:</label>
                        <input type="number" id="year" name="year" value="<?php echo $bookToEdit['publishing_year']; ?>">
                    </p>
                    <p>
                        <label for="genre">Genre:</label>
                        <select id="genre" name="genre">
                            <option value="Adventure" <?php echo $bookToEdit['genre'] == 'Adventure' ? 'selected' : ''; ?>>Adventure</option>
                            <option value="Classic Literature" <?php echo $bookToEdit['genre'] == 'Classic Literature' ? 'selected' : ''; ?>>Classic Literature</option>
                            <option value="Coming-of-age" <?php echo $bookToEdit['genre'] == 'Coming-of-age' ? 'selected' : ''; ?>>Coming-of-age</option>
                            <option value="Fantasy" <?php echo $bookToEdit['genre'] == 'Fantasy' ? 'selected' : ''; ?>>Fantasy</option>
                            <option value="Historical Fiction" <?php echo $bookToEdit['genre'] == 'Historical Fiction' ? 'selected' : ''; ?>>Historical Fiction</option>
                            <option value="Horror" <?php echo $bookToEdit['genre'] == 'Horror' ? 'selected' : ''; ?>>Horror</option>
                            <option value="Mystery" <?php echo $bookToEdit['genre'] == 'Mystery' ? 'selected' : ''; ?>>Mystery</option>
                            <option value="Romance" <?php echo $bookToEdit['genre'] == 'Romance' ? 'selected' : ''; ?>>Romance</option>
                            <option value="Science Fiction" <?php echo $bookToEdit['genre'] == 'Science Fiction' ? 'selected' : ''; ?>>Science Fiction</option>
                        </select>
                    </p>
                    <p>
                        <label for="description">Description:</label>
                        <textarea id="description" name="description" style="width: 100%; height: 150px;"><?php echo $bookToEdit['description']; ?></textarea>
                    </p>
                    <input type="submit" value="Edit Book">
                </form>
            </main>
        </div>
    </body>

    </html>
<?php
}
?>