<?php

class Resultat {

    private string $id;
    private string $note;
    private string $id_user;
    private string $id_examen;

    public function __construct($id, $note, $id_user, $id_examen)
    {
        $this->id = $id;
        $this->note = $note;
        $this->id_user = $id_user;
        $this->id_examen = $id_examen;
    }

    public function set_id($val){
        $this->id = $val;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_note($val){
        $this->note = $val;
    }

    public function get_note(){
        return $this->note;
    }

    public function set_id_user($val){
        $this->id_user = $val;
    }

    public function get_id_user(){
        return $this->id_user;
    }

    public function set_id_examen($val){
        $this->id_examen = $val;
    }

    public function get_id_examen(){
        return $this->id_examen;
    }

}

?>
