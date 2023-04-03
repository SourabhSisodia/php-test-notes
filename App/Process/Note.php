<?php
namespace App\Process;

use App\Libraries\Database;

class Note
{
    private $db;
    public function __construct()
    {
        if (!isLoggedIn()) {
            header("Location:/user/login");
            exit();
        }
        $db = new Database();
    }
    public function home()
    {

        require_once APPROOT . "/Frontend/Notes/Home.php";
    }
    public function addNote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'));
            $title = $data->title;
            $body = $data->body;
            $id = $_SESSION["user"];

            $query = "INSERT INTO notes (user_id,title,body) VALUES ($id,'$title','$body')";
            $this->db->execute($query);

        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = [];
            $query =
                "select user.name,notes.title,notes.body,notes.created_at from user join notes on user.id = notes.user_id";
            $result = $this->db->execute($query);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i]['name'] = $row['name'];
                $data[$i]['body'] = $row['body'];
                $data[$i]['title'] = $row['title'];
                $i++;
            }
            echo json_encode($data, true);

        }
    }
    public function deleteNote()
    {
        $id = $_POST['id'];
        $query = "DELETE FROM notes WHERE id='$id'";
        $this->db->execute($query);
    }
    public function editNote()
    {
        $title = $_POST["title"];
        $body = $_POST["body"];

        $id = $_POST["id"];
        $query = "UPDATE notes SET body = '$body' , title = '$title' WHERE id = '$id'";
        $this->db->execute($query);
    }

}
