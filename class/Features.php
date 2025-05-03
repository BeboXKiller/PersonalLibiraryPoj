<?php

namespace App;

class Features 
{
    private $db;

    public function __construct()
    {
        $this->db = new \App\DB();
    }

    public function addBook()
    {
        if (!isset($_SESSION['userID'])) {
            \App\Alert::PrintMessage("You must be logged in to add a book.", 'Danger');
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            if (empty($_POST['title']) || empty($_POST['author'])) {
                \App\Alert::PrintMessage("Title and author are required fields.", 'Danger');
                return false;
            }

            // Sanitize input
            $title = trim($_POST['title']);
            $author = trim($_POST['author']);
            $user_id = $_SESSION['userID'];

            // Prepare and execute the query
            $stmt = $this->db->Connection->prepare("INSERT INTO books (title, author, user_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $title, $author, $user_id);
            
            if ($stmt->execute()) {
                \App\Alert::PrintMessage("Book has been added successfully!", 'Success');
                return true;
            } else {
                \App\Alert::PrintMessage("Error adding book: " . $stmt->error, 'Danger');
                return false;
            }
            
            $stmt->close();
        }
        return false;
    }

    public function getBooks()
    {
        if (!isset($_SESSION['userID'])) {
            return [];
        }

        $user_id = $_SESSION['userID'];
        $stmt = $this->db->Connection->prepare("SELECT * FROM books WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        
        $stmt->close();
        return $books;
    }

    public function __destruct()
    {
        if ($this->db && $this->db->Connection) {
            $this->db->Connection->close();
        }
    }
}

?>