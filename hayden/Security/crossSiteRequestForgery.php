<?php

class CSRF {

    //This is a sample of how we can prevent cross site request forgery (CSRF).
    //Cross-Site Request Forgery is a type of attack that occurs when a malicious Web site, email, blog, instant message,
    //or program causes a user’s Web browser to perform an unwanted action on a trusted site for which the user is currently authenticated.
    //The most common way to prevent CSRF is to associate a randomly generated token with a users session.
    //This is assuming that every time a customer logs on to our site a new session is created.

    //The first step is to get the token id from the users session.
    //If a token does not exist then it randomly creates one.
    public function get_token_id() {
        //If a token exists return its id.
        if(isset($_SESSION['token_id'])) {
            return $_SESSION['token_id'];
        } else {
            //If a token does not exist create a new one with a random id from 1-10.
            $token_id = $this->random(10);
            //Set the new token id to the randomly generated number.
            $_SESSION['token_id'] = $token_id;
            //Return the token id.
            return $token_id;
        }
    }

    //Check if a token has already been assigned a value.
    //If it has, return that token.
    public function getToken() {
        if (isset($_SESSION['token_value'])) {
            return $_SESSION['token_value'];
        } else {
            //Otherwise generate a new token.
            //In this case i'm generating a random number between one and five hundred, in reality it will be randomly generated hash like "OWY4NmQwODE4".
            $token = $this->random(500);
            //Set the session's token value to the random number.
            $_SESSION['token_value'] = $token;
            //Return the token.
            return $token;
        }
    }


    //Now that we have created a token, we can use it to check that a get or post is coming from a legitimate user

    public function checkValidToken() {
        //First check for gets and posts
        if ($method == 'post' || $method == 'get') {
            $post = $_POST;
            $get = $_GET;
            //Check the values of the get or post request with the values stored in the users session variable.
            if(isset(${$method}[$this->get_token_id()]) && (${$method}[$this->get_token_id()] == $this->get_token())) {
                //If the values match return true (allow the get or post to proceed).
                return true;
            } else {
                //Otherwise return false (prevent the get or post from executing).
                return false;
            }
        } else {
            return false;
        }
    }

}

?>