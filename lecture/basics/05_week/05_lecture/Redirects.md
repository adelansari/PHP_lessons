# Redirects

## Let's move the user to a new location

PHP allows redirecting the user from one page to another. This is commonly seen, for example, when you make an order in an online store and are redirected to “thank you” page. Unlike with Javascript redirects, the intermediate page doesn’t appear in browser history at all.

PHP uses HTTP headers for redirecting, so if you want to redirect the user somewhere, this must be done **before any HTML (or other output) is written on the page**. If there is any output, you will get the error “headers already sent”. Doing whatever else – like saving that order in the database - with PHP first is fine. (If you’re certain you’re not outputting anything before the redirect and it’s still giving errors, make sure there’s no blank lines before the <?php tag. Other error messages generated by PHP are also output.)

Redirects are done by setting the “location” header. **However, this does not immediately redirect the user**. The whole page is executed first. Often, this is harmless, but sometimes it’s really not a good idea. So make a habit of always stopping the rest of the page from executing by calling either `exit` or `die` function – unless you really want the entire page to execute first.

```php
<?php
    // do whatever the page is meant to do

    header("Location: thankyou.html");
    exit();
?>
```

As far as functionality goes, exit and die functions are identical. Both stop everything after them from happening. Some people say that die() is meant to be used when something goes wrong, exit() when you just want to stop execution. Others disagree.

## You're not supposed to be here

Another common use of redirects is to kick the users out of the pages they’re not supposed to be on. This is an important part of user authentication.

**Never, ever rely on hiding the URLs of restricted pages**! Someone will always find them – hackers also have tools that automatically go through every possible URL by stringing letters together and record what pages exist. If the page is restricted, the first thing to do is to check the user has permission to visit it.

This is really easy to do with sessions. Check if the variable used in logging in is set, and if not, redirect the user to login page.

```php
if(!isset($_SESSION["userid"])) {   // or whichever session variable you use for login
    header("Location: login.php");

    exit();
}
```

You must call exit() (or die()) after redirect. The last thing you want is to allow whatever PHP code there is to run before redirecting the user. Just think if this was a bank transaction anyone could execute without authorization!
