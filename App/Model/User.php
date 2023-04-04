<?php
namespace App\Model;

use App\Libraries\Database;

/**
 * User
 *performs all the functions on user database
 */
class User
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    /**
     * login
     *checks if a user with given email and password exists or not
     * @param  mixed $data
     * @return void
     */
    public function login($data)
    {
        // destructure email and password
        $email = $data["email"];
        $password = $data["password"];
        $query = "SELECT `id`,`email` from user where email = '$email' and password = '$password'";
        $result = $this
            ->db
            ->execute($query);
        if ($result->num_rows) {
            return $result->fetch_assoc();
        }
        return false;
    }
    /**
     * register
     *saves new user data into the database with all the checks
     * @param  mixed $data
     * @return void
     */
    public function register($data)
    {
        // destructure email and password
        $name = $data["name"];
        $email = $data["email"];
        $password = $data["password"];

        // create insert query
        $query = "INSERT INTO user (name,email,password)
        VALUES ('$name','$email', '$password')";
        $result = $this
            ->db
            ->execute($query);
        // returns result
        return $result;
    }
    /**
     * userExist
     *checks if a user with a given email exist or not
     * @param  mixed $email
     * @return void
     */
    public function userExist($email)
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
