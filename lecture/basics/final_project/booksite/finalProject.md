# Project description

## Introduction

This project puts together everything you have learned this far (conditionals, loops, form input, sessions, cookies, reading and writing from file). You’ll be provided with HTML/CSS templates but may need to do some light editing. The topic is a small book site.

The “basic version” of the site with only visitor functionality is mandatory. If you have time, you can also implement the admin side to add and delete books.

Below you will also find data files in CSV and JSON format. Use whichever you wish. `If you are planning to code also the admin side`, it’s recommended to use JSON format. That makes deleting a book a whole lot easier than with CSV.

## Visitor side (mandatory)

The site contains books (saved in CSV or JSON file). The visitor side reads the file and shows the books of the corresponding genre in each genre page. It’s also possible for the visitor to “favorite” or “unfavorite” certain books by clicking on the star symbol next to each book. The favorite list is saved on the visitor’s device as a cookie and read on the server in order to display the correct symbol for each book.

You can find the detailed instructions in the template files (`booksite.php` and `setfavorite.php`).

## Admin side (optional)

In the admin page, the user can add a new book, delete an existing book and log out. If you wish, you can also add the functionality to edit an existing book. All the changes to the books are saved in the data file.

The admin side can only be accessed by logging in (`login.php`). The admin page (`admin.php`) checks if the user is logged in and boots intruders back to the login page. Also the pages for adding a book (addbook.php) and deleting a book (deletebook.php) should boot any unlogged users back to login page. Use sessions for this for better security than cookies.

How the correct username / password combinations are saved (separate file or part of PHP code) is up to you. On a real server accessible online, it should always be a file that can’t be accessed over the Internet (so some other folder in the server) – and the passwords should be encrypted too -, but this is just a practice project.
