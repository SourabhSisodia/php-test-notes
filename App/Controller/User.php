<?php
namespace App\Controller;

use App\Model\User as user_model;

/**
 * User
 * user class handles all the user routes and perform login,logout and register functions
 */
class User
{
    private $user_model;
    public function __construct()
    {
        $this->user_model = new user_model();
    }
    /**
     * login
     *checks if user exist , email and password are correct and perform functions according to that
     * @return void
     */
    public function login()
    {
        if (isLoggedIn()) {
            header("Location:/note/home");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $data = [
                "email" => $_POST["email"],
                "password" => $_POST["password"],
            ];
            if ($this->user_model->userExist($data["email"])) {
                $result = $this->user_model->login($data);
                if ($result) {
                    setSession($result);
                    header("Location:/note/home");
                    exit();
                } else {
                    header("Location:/user/login");
                    exit();
                }
            } else {
                header("Location:/user/register");
                exit();
            }
        } else {
            require_once APPROOT . "/View/User/Login.php";
        }
    }
    /**
     * register
     *saves new user data in the database
     * @return void
     */
    public function register()
    {
        if (isLoggedIn()) {
            header("Location:/note/home");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $data = [
                "email" => $_POST["email"],
                "password" => $_POST["password"],
                "name" => $_POST["username"],
            ];

            if ($this->user_model->userExist($data["email"])) {
                // user already exist
            } else {
                $result = $this->user_model->register($data);
            }
            header("Location:/user/login");
            exit();
        } else {
            require_once APPROOT . "/View/User/Register.php";
        }

    }
    /**
     * logout
     *logout user
     * @return void
     */
    public function logout()
    {
        logOut();
        header("Location:/" . 'user/login');
        exit();
    }

}
