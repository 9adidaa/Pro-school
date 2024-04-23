<?php

require 'connect.php'; 

class ResultatCon {

    private $tab_name;

    public function __construct($tab_name) {
        $this->tab_name = $tab_name;
    }

    public function getResultat($id) {
        $sql = "SELECT * FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $resultat = $query->fetch();
            return $resultat;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listResultats() {
        $sql = "SELECT * FROM $this->tab_name";

        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addResultat($note, $id_user, $id_examen) {
        $sql = "INSERT INTO $this->tab_name (note, id_user, id_examen) VALUES (:note, :id_user, :id_examen)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'note' => $note,
                'id_user' => $id_user,
                'id_examen' => $id_examen
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateResultat($id, $note, $id_user, $id_examen) {
        $sql = "UPDATE $this->tab_name SET note = :note, id_user = :id_user, id_examen = :id_examen WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'note' => $note,
                'id_user' => $id_user,
                'id_examen' => $id_examen
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteResultat($id) {
        $sql = "DELETE FROM $this->tab_name WHERE id = :id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

}

?>
