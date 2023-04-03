<?php
namespace App\Process;

use App\Libraries\Database;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function login()
    {
        if (isLoggedIn()) {
            header("Location:/note/home");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST["email"];
            $password = $_POST["password"];
            if ($this->userExist($email)) {
                $query = "SELECT `id`,`email` from user where email = '$email' and password = '$password'";
                $result = $this
                    ->db
                    ->execute($query);
                if ($result->num_rows) {
                    $data = $result->fetch_assoc();
                    setSession($data);
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
            require_once APPROOT . "/Frontend/User/Login.php";
        }
    }
    public function register()
    {
        if (isLoggedIn()) {
            header("Location:/note/home");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $name = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            if ($this->userExist($email)) {
                header("Location:/user/login");
                exit();
            }
            $query = "INSERT INTO user (name,email,password)
            VALUES ('$name','$email', '$password')";
            $result = $this
                ->db
                ->execute($query);
            header("Location:/user/login");
            exit();
        } else {
            require_once APPROOT . "/Frontend/User/Register.php";
        }

    }
    public function logout()
    {
        logOut();
        header("Location:/" . 'user/login');
        exit();
    }
    private function userExist($email)
    {
        $query = "SELECT email from user where email = '$email'";
        //executes query
        $result = $this
            ->db
            ->execute($query);
        if ($result->num_rows) {
            return true;
        }
        return false;
    }
}
