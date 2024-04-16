<?php

class Examen {

    private string $id;
    private string $titre;
    private string $date;
    private string $id_class; 
    private string $id_subject; 
    

    
    public function __construct(string $id, string $titre, string $date, string $id_class, string $id_subject)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->date = $date;
        $this->id_class = $id_class; 
        $this->id_subject = $id_subject; 
    }
    public function set_id(string $val) {
        $this->id = $val;
    }

    public function get_id(): string {
        return $this->id;
    }

    public function set_titre(string $val) {
        $this->titre = $val;
    }

    public function get_titre(): string {
        return $this->titre;
    }

    public function set_date(string $val) {
        $this->date = $val;
    }

    public function get_date(): string {
        return $this->date;
    }


    
    public function set_id_class(string $val) {
        $this->id_class = $val;
    }

    public function get_id_class(): string {
        return $this->id_class;
    }

    public function set_id_subject(string $val) {
        $this->id_subject = $val;
    }

    public function get_id_subject(): string {
        return $this->id_subject;
    }
}

?>
