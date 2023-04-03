<?php
namespace App\Controller;

use App\Model\Note as note_model;

/**
 * Note
 * This class handles all request to note/ routes and perform add edit view and delete function
 */
class Note
{
    private $notes_model;
    public function __construct()
    {
        if (!isLoggedIn()) {
            header("Location:/user/login");
            exit();
        }
        $this->notes_model = new note_model();
    }
    public function home()
    {

        require_once APPROOT . "/View/Notes/Home.php";
    }
    /**
     * add
     *saves new notes and calls save function from model
     * @return void
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $req = json_decode(file_get_contents('php://input'));
            $data = [];
            $data['title'] = $req->title;
            $data['body'] = $req->body;

            $this->notes_model->save($data);
            echo json_encode($req, true);
        }

    }
    /**
     * show
     *sends notes data to frontend
     * @return void
     */
    public function show()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $data = $this->notes_model->show();
            echo json_encode($data, true);
        }
    }
    /**
     * delete
     * deletes a selected note
     * @return void
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $this->notes_model->delete($id);

        }
        header("Location:/note/home");
        exit();
    }
    /**
     * edit
     *edits posts data by sending data to the edit function in notes model
     * @return void
     */
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data['title'] = $_POST["title"];
            $data['body'] = $_POST["body"];
            $data['id'] = $_POST["id"];
            $this->notes_model->edit($data);
        }
        header("Location:/note/home");
        exit();

    }
    public function specific()
    {
        print_r($_POST['id']);
    }

}
