<?php
session_start();
function setSession($data)
{
    $_SESSION["user"] = $data["id"];
    $_SESSION["email"] = $data["email"];
}
function isLoggedIn()
{
    if (isset($_SESSION["user"])) {
        return true;
    }
    return false;
}
function logout()
{
    session_unset();
    session_destroy();
}
