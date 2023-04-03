<?php
namespace App\Model;

use App\Libraries\Database;

/**
 * Note
 * perform all the operations on notes database
 */
class Note
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    /**
     * save
     *saves new notes data in the database
     * @param  mixed $data
     * @return void
     */
    public function save($data)
    {
        $id = $_SESSION['user'];
        $title = $data['title'];
        $body = $data['body'];

        $query = "INSERT INTO notes (user_id,title,body) VALUES ('$id','$title','$body')";
        $result = $this->db->execute($query);

    }
    /**
     * show
     *shows all the notes in descending order on the note/home page
     * @return mixed
     */
    public function show()
    {
        $id = $_SESSION['user'];
        $query = "SELECT id,title,body,created_at from notes where user_id = '$id' ORDER BY  `created_at` DESC";
        $result = $this->db->execute($query);
        $data = [];
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $data[$i]['title'] = $row['title'];
            $data[$i]['body'] = $row['body'];
            $data[$i]['created'] = $row['created_at'];
            $data[$i]['id'] = $row['id'];
            $i++;
        }
        return $data;
    }
    /**
     * delete
     *deletes a note of a given id
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $query = "DELETE FROM notes WHERE id='$id'";
        $this->db->execute($query);
    }
    /**
     * edit
     * updates a given note
     * @param  mixed $data
     * @return void
     */
    public function edit($data)
    {
        $id = $data['id'];
        $title = $data['title'];
        $body = $data['body'];
        $query = "UPDATE notes SET body = '$body' , title = '$title' WHERE id = '$id'";
        $this->db->execute($query);

    }
}
