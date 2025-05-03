<?php

namespace App;

class Features 
{

    public function addBook()
    {
        if (isset($_POST["title"]) && isset($_POST["author"])) {
            $title = $_POST["title"];
            $author = $_POST["author"];
            
            $user_id = 1;
            
            $db = new \mysqli("localhost", "root", "", "bookinventory_db");
            
            if ($db->query("INSERT INTO books (title, author, user_id) VALUES ('$title', '$author', $user_id)")) {
                \App\Alert::PrintMessage("Book has been added successfully!", 'Success');
            } else {
                \App\Alert::PrintMessage("Error adding book.", 'Danger');
            }
        }
    }
    
}

?>