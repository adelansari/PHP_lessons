# Reading and writing files

## The simplest case

If you just want to get the contents of the entire file, the easiest function to use is `file_get_contents`. This opens, reads and closes the file. It returns the contents as a string. If there’s an error (e.g. file does not exist), it returns false.

```php
$filetext = file_get_contents("test.txt");

print $filetext;
```

And for writing, there’s `file_put_contents`. It opens the file, writes the given data to it and closes it.

```php
$text = "Hello PHP!";
file_put_contents("test.txt", $text);
```

## Reading line by line

A more common approach when reading text files is to read one line at a time and do something with it before moving on to the next. The best function for this is `fgets`. You may see `fread` function in many examples online, but this is a bit problematic, since it requires the parameter how many bytes to read. So you would need to know how long each line is exactly. fgets just reads until line break (or end of file (eof), if this is the last line).

Unlike `file_get_contents`, fgets does not open or close the file. You need to do this manually.

```php
$readfile = fopen("notes.txt", "r") or die("Failed to open the file");

while(!feof($readfile)) {    // keep going while we haven’t reached the end of file yet
   print fgets($readfile) . "<br>";
}

fclose($readfile);
```

- `fopen` opens the file – for reading with “r” flag – and returns the file pointer (the location in the file we are currently at) placed at the beginning of the file.

- `fgets` moves the file pointer every time it reads a line. We can check if the pointer has reached the end of the file with a function called feof (file – end-of-file).

The last point of note is that the attempt to open the file terminates the PHP script if the file can’t be opened. The part “or die” means that only the error message given as its parameter is printed, but nothing after it in the code happens. Admittedly, sometimes there is a genuine error in reading a file, but most common cause is that the file doesn’t exist. For a little better code, we can check if the file is there before trying to open it.

```php
if(file_exists("notes.txt")){

    $readfile = fopen("notes.txt", "r") or die("Failed to open the file");
    while(!feof($readfile)) {    // keep going while we haven’t reached the end of file yet
        print fgets($readfile) . "<br>";
    }
    fclose($readfile);
}
```

## Writing to text file

There are two ways to open a file for writing: overwrite (“w” flag) and append (“a” flag). Both create the file if it doesn’t exist. **Be careful with the “w” flag, so you don’t overwrite something you didn’t mean to**. It’s also possible to open a file for both reading and writing/appending at the same time, but since that also requires manipulating the location of the file pointer manually, we’re not using that in this course.

The writing itself is done with fwrite (or fputs, if you like – they’re aliases of the same function). Note! Neither adds a line break. If you want there to be one, write “\n”.

For example, write all the Disney movies in the array to a new file.

$movies = array("Lady and the Tramp", "Sleeping Beauty", "One Hundred and One Dalmatians", "The Sword in the Stone");

$writefile = fopen("movies.txt", "w");

foreach($movies as $movie) {
    fwrite($writefile, $movie . "\n");
}

fclose($writefile);

As another example, let’s add one more to the existing file.

$writefile = fopen("movies.txt", "a");
fwrite($writefile, "The Jungle Book\n");
fclose($writefile);
