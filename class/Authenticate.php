<?php

namespace App;

class Authenticate
{   


    public function isValidEmail($email)
    {
        // Basic regex for validating an email address
        $pattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
        return preg_match($pattern, $email) === 1;
    }

    public function emailExists($email)
    {
        $myDBObject = new DB();
        $selectStatement = 'SELECT email FROM `users` WHERE email = ?';
        $queryStmtObject = $myDBObject->Connection->prepare($selectStatement);
        $queryStmtObject->bind_param('s', $email);
        $queryStmtObject->execute();
        $result = $queryStmtObject->get_result();
        return $result->num_rows > 0;
    }

    public function usernameExists($username)
    {
        $myDBObject = new DB();
        $selectStatement = 'SELECT username FROM `users` WHERE username = ?';
        $queryStmtObject = $myDBObject->Connection->prepare($selectStatement);
        $queryStmtObject->bind_param('s', $username);
        $queryStmtObject->execute();
        $result = $queryStmtObject->get_result();
        return $result->num_rows > 0;
    }
     
    public function isAuth()
    {
        return isset($_SESSION['userID']); // bool
    }

    public function redirectIfAuth()
    {
        // Used in page SignIn & SignUp
        if ($this->isAuth())
            header('location: index.php');
    }


    public function signUp()
    {
        if (isset($_POST['signUpBtn'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];

            // Check if username already exists
            if ($this->usernameExists($username)) {
                \App\Alert::PrintMessage("Username already exists", 'Danger');
                return;
            }
            
            // Then validate email format
            if (!$this->isValidEmail($email)) {
                \App\Alert::PrintMessage("Please enter a valid email address", 'Danger');
                return;
            }

            // Then check if email exists
            if ($this->emailExists($email)) {
                \App\Alert::PrintMessage("Email already exists", 'Danger');
                return;
            }
            
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password != $confirmPassword)
                \App\Alert::PrintMessage("Confirm Password not matched", 'Danger');
            
            $myDatabaseObj = new \App\DB();
            $insertStatement = "INSERT INTO `users` VALUES(NULL,?,?,?)"; // Sql injection
            $queryObj = $myDatabaseObj->Connection->prepare($insertStatement);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $queryObj->bind_param('sss', $username, $email, $hashedPassword);
            $queryStatus = $queryObj->execute();
            if ($queryStatus)
                header('location: SignIn.php?doneSignUp=1');
            else
                Alert::PrintMessage("Failed to create your account", 'Danger');
        }
    }

    public function signIN()
    {
        if (isset($_POST['signINBtn'])) {
            $password = $_POST['password'];
            $email = $_POST['email'];
    
            if (empty($password) || empty($email)) {
                \App\Alert::PrintMessage("Email or Password is required.", 'Danger');
                return;
            }
    
            if (!$this->isValidEmail($email)) {
                \App\Alert::PrintMessage("Please enter a valid email address", 'Danger');
                return;
            }
    
            $myDatabaseObj = new \App\DB();
            $query = "SELECT id, username, password FROM `users` WHERE email = ?";
            $queryObj = $myDatabaseObj->Connection->prepare($query);
            $queryObj->bind_param('s', $email);  
            $queryObj->execute();
    
            $result = $queryObj->get_result();
    
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['userID'] = $user['id'];
                    $_SESSION['userName'] = $user['username'];
                    $this->redirectIfAuth();
                    exit;
                } else {
                    \App\Alert::PrintMessage("Incorrect password", 'Danger');
                }
            } else {
                \App\Alert::PrintMessage("No account found with that email", 'Danger');
            }
        }
    }
    
}