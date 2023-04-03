<?php
session_start();
/**
 * setSession
 *sets session values
 * @param  mixed $data
 * @return void
 */
function setSession($data)
{
    $_SESSION["user"] = $data["id"];
    $_SESSION["email"] = $data["email"];
}
/**
 * isLoggedIn
 *checks if user is logged in or not
 * @return boolean
 */
function isLoggedIn()
{
    if (isset($_SESSION["user"])) {
        return true;
    }
    return false;
}
/**
 * logout
 *destroys and unset session
 * @return void
 */
function logout()
{
    session_unset();
    session_destroy();
}
