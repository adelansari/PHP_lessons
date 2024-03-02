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
                <li><a href="booksite.php">Home</a></li>
                <li><a href="booksite.php?genre=adventure">Adventure</a></li>
                <li><a href="booksite.php?genre=classic">Classic Literature</a></li>
                <li><a href="booksite.php?genre=coming-of-age">Coming-of-age</a></li>
                <li><a href="booksite.php?genre=fantasy">Fantasy</a></li>
                <li><a href="booksite.php?genre=historical">Historical Fiction</a></li>
                <li><a href="booksite.php?genre=horror">Horror</a></li>
                <li><a href="booksite.php?genre=mystery">Mystery</a></li>
                <li><a href="booksite.php?genre=romance">Romance</a></li>
                <li><a href="booksite.php?genre=scifi">Science Fiction</a></li>
            </ul>
        </nav>
        <main>
            <?php
                // Here you should display the books of the given genre (GET parameter "genre"). Check the links above for parameter values.
                // If the parameter is not set, display all books.

                // Use the HTML template below and a loop (+ conditional if the genre was given) to go through the books in file  
                
                // You also need to check the cookies to figure out if the book is favorite or not and display correct symbol.
                // If the book is in the favorite list, add the class "fa-star" to the a tag with "bookmark" class.
                // If not, add the class "fa-star-o". These are Font Awesome classes that add a filled star and a star outline respectively.
                // Also, make sure to set the id parameter for each book, so the setfavorite.php page gets the information which book to favorite/unfavorite.

                // Read the book data from books.json
                $books = json_decode(file_get_contents('books.json'), true);

                // Get the genre from the GET parameter
                $genre = isset($_GET['genre']) ? $_GET['genre'] : null;

                // Get the favorite books from the cookies
                $favorites = isset($_COOKIE['favorites']) ? json_decode($_COOKIE['favorites'], true) : [];

                foreach ($books as $id => $book) {
                    // If a genre is given and the book's genre doesn't match, skip this book
                    if ($genre !== null && $book['genre'] !== $genre) {
                        continue;
                    }

                    // Check if the book is a favorite
                    $isFavorite = in_array($id, $favorites);

                    // Display the book
                    echo '<section class="book">';
                    echo '<a class="bookmark fa ' . ($isFavorite ? 'fa-star' : 'fa-star-o') . '" href="setfavorite.php?id=' . $id . '"></a>';
                    echo '<h3>' . htmlspecialchars($book['title']) . '</h3>';
                    echo '<p class="publishing-info">';
                    echo '<span class="author">' . htmlspecialchars($book['author']) . '</span>,';
                    echo '<span class="year">' . htmlspecialchars($book['year']) . '</span>';
                    echo '</p>';
                    echo '<p class="description">' . htmlspecialchars($book['description']) . '</p>';
                    echo '</section>';
                }
            ?>
            <h2>Genre Name or "All Books"</h2>

            <section class="book">
                <a class="bookmark fa fa-star-o" href="setfavorite.php?id=1"></a>
                <h3>To Kill a Mockingbird</h3>
                <p class="publishing-info">
                    <span class="author">Harper Lee</span>,
                    <span class="year">1960</span>
                </p>
                <p class="description">
                    Harper Lee's masterpiece explores racial injustice and moral growth through the eyes of a young girl in the American South.
                </p>
            </section>

        </main>
    </div>    
</body>
</html>