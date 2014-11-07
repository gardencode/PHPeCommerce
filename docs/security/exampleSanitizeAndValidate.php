<?php

//This is an example of how we can protect ourselves against cross site scripting (XSS) by sanitizing and validating form data that comes from the client through post.
//Mikes rule of thumb is never trust anything being sent from the client.

    print '<html>' .
        '<body>' .
        '<p>Hello world!</p>' .
        '<form method="post" action="exampleSanitizeAndValidate.php">' .
        '<a>Name:</a>' .
        '<br>' .
        '<input type="text" name="name">' .
        '<br>' .
        '<a>Email Address:</a>' .
        '<br>' .
        '<input type="text" name="email">' .
        '<br>' .
        '<a>URL:</a>' .
        '<br>' .
        '<input type="text" name="url">' .
        '<br>' .
        '<input type="submit" name="submit">' .
        '</form>' .
        '</body>' .
        '<html>';

    //Check that the form has been submitted.
    if (isset($_POST['submit'])) {

        //Sanitize the name field. This will remove harmful html tags.

        //Check that the name field is not empty.
        if ($_POST['name'] != "") {
            //The FILTER_SANITIZE_STRING filter strips or encodes unwanted characters.
            //This filter removes data that is potentially harmful for your application. It is used to strip tags and remove or encode unwanted characters.
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            if ($name == "") {
                //Print if name field is empty after harmful characters have been removed.
                print "$name is an invalid name" . '<br>';
            } else {
                //Print if name field is not empty after harmful characters have been removed.
                print "$name is a valid name" . '<br>';
            }
        } else {
            //Print if name field is empty at time of post.
            print "Please enter your name>" . '<br>';
        }

        //Sanitize and validate the email field.
        if (isset($_POST['email'])) {
            //The FILTER_SANITIZE_EMAIL filter removes all illegal e-mail characters from a string.
            //This filter allows all letters, digits and $-_.+!*'{}|^~[]`#%/?@&=
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            //The FILTER_VALIDATE_EMAIL filter validates value as an e-mail address.
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "$email is a valid email address" . '<br>';
            } else {
                echo "$email is NOT a valid email address" . '<br>';
            }
        }

        //Sanitize and validate the url field.
        if (isset($_POST['url'])) {
            //The FILTER_SANITIZE_URL filter removes all illegal URL characters from a string.
            //This filter allows all letters, digits and $-_.+!*'(),{}|\\^~[]`"><#%;/?:@&=
            $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
            //The FILTER_VALIDATE_URL filter validates value as a URL.
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                echo "$url is a valid url" . '<br>';
            } else {
                echo "$url is NOT a valid url" . '<br>';
            }
        }

    }

?>