<?php

require 'connect.php';
class UserCon
{

    private $tab_name;

    public function __construct($tab_name = 'user')
    {
        $this->tab_name = $tab_name;
    }

    public function getUser($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE Id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function getUser_email($email)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE email = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $email);
            $query->execute();
            $user = $query->fetch();
            return $user;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }


    public function listUsers()
    {
        $sql = "SELECT * FROM $this->tab_name";
        $db = config::getConnexion();

        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addUser($email, $role, $name, $lastname, $password, $status, $age)
    {
        $db = config::getConnexion();

        $sql = "INSERT INTO $this->tab_name (email, role, name, lastname, Password, status, age) VALUES (:email, :role, :name, :lastname, :password, :status, :age)";



        try {
            $query = $db->prepare($sql);
            $query->execute([
                'email' => $email,
                'role' => $role,
                'name' => $name,
                'lastname' => $lastname,
                'password' => $password,
                'status' => $status,
                'age' => $age
            ]);
            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function update_etu($id, $class)
    {
        $sql = "UPDATE etudiants SET id_class = :class where id_user = :user_id ;";
        $db = config::getConnexion();

        $query = $db->prepare($sql);
        $query->execute([
            'user_id' => $id,
            'class' => $class
        ]);
    }
    public function add_etu($class)
    {
        $sql = "INSERT INTO etudiants (id_user,id_class) values(:user_id,:class);";
        $db = config::getConnexion();
        $userId = $db->lastInsertId();

        $query = $db->prepare($sql);
        $query->execute([
            'user_id' => $userId,
            'class' => $class
        ]);
    }
    public function update_ens($id, $subject)
    {
        $sql1 = "UPDATE enseignant SET id_subject = :subject WHERE id_user = :user_id";
        $db = config::getConnexion();

        $query1 = $db->prepare($sql1);
        $query1->execute([
            'user_id' => $id,
            'subject' => $subject
        ]);
    }
    public function add_ens($subject)
    {
        $sql1 = "INSERT INTO enseignant (id_user,id_subject) values(:user_id,:subject);";
        $db = config::getConnexion();
        $userId = $db->lastInsertId();

        $query1 = $db->prepare($sql1);
        $query1->execute([
            'user_id' => $userId,
            'subject' => $subject
        ]);
    }



    public function updateUser($id, $email, $role, $name, $lastname, $password, $status, $age)
    {
        $db = config::getConnexion();
        // First, check if the email already exists in the database


        $sql = "UPDATE $this->tab_name SET email = :email, role = :role, name = :name, lastname = :lastname, Password = :password, status = :status, age = :age WHERE Id = :id";


        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'email' => $email,
                'role' => $role,
                'name' => $name,
                'lastname' => $lastname,
                'password' => $password,
                'status' => $status,
                'age' => $age
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE Id = :id";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
