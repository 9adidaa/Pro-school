<?php

require 'connect.php';

class examenCon
{

    private $tab_name;

    public function __construct($tab_name = 'examen')
    {
        $this->tab_name = $tab_name;
    }

    public function getExamen($id)
    {
        $sql = "SELECT * FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            $examen = $query->fetch();
            return $examen;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listExamens()
    {
        $sql = "SELECT * FROM $this->tab_name";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addExamen($examen)
    {
        $sql = "INSERT INTO $this->tab_name (titre, date, id_class, id_subject) VALUES (:titre, :date, :id_class, :id_subject)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'titre' => $examen->get_titre(),
                'date' => $examen->get_date(),
                'id_class' => $examen->get_id_class(),
                'id_subject' => $examen->get_id_subject()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    function updateExamen($examen, $id)
    {
        $sql = "UPDATE $this->tab_name SET titre = :titre, date = :date, id_class = :id_class, id_subject = :id_subject WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'titre' => $examen->get_titre(),
                'date' => $examen->get_date(),
                'id_class' => $examen->get_id_class(),
                'id_subject' => $examen->get_id_subject()
            ]);

            $affectedRows = $query->rowCount();

            if ($affectedRows > 0) {
                // Create a string summarizing the operation and return it
                $updatedExamenInfo = "Updated successfully: {$examen->get_titre()}, Date: {$examen->get_date()}, Affected Rows: $affectedRows";
                return $updatedExamenInfo;
            } else {
                return "No changes were made to the record.{$id}, Date: {$examen->get_id()}, Affected Rows: $affectedRows";
            }
        } catch (PDOException $e) {
            return "Error updating examen: " . $e->getMessage();
        }
    }



    function deleteExamen($id)
    {
        $sql = "DELETE FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
            echo $req->rowCount() . " record(s) DELETED successfully";
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
