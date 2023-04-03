<?php

namespace App\Controller;

/**
 * Home
 * handle default request and request to home page
 */
class Home
{
    public function __construct()
    {
        // if user is logged in then redirect to note/home
        if (isLoggedIn()) {
            header("Location:/note/home");
            exit();
        }
        // includes view for home page
        require_once APPROOT . "/View/Home/Home.php";
    }
}
