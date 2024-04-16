<?php

require 'connect.php';

class SubjectCon {

    private $tab_name;

    public function __construct($tab_name = 'subject') {
        $this->tab_name = $tab_name;
    }

    public function getSubject($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE Id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $subject = $query->fetch();
            return $subject;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listSubjects()
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

    public function addSubject($name)
    {
        $sql = "INSERT INTO $this->tab_name (name) VALUES (:name)";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['name' => $name]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateSubject($id, $name)
    {
        $sql = "UPDATE $this->tab_name SET name = :name WHERE Id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id, 'name' => $name]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteSubject($id)
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

?>
