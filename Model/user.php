<?php

class User {
    private string $id, $email, $role, $name, $lastname, $password, $status, $age;

    public function __construct($id, $email, $role, $name, $lastname, $password, $status, $age) {
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->status = $status;
        $this->age = $age;
    }

    // Getters and setters for each property
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getRole() { return $this->role; }
    public function setRole($role) { $this->role = $role; }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getLastname() { return $this->lastname; }
    public function setLastname($lastname) { $this->lastname = $lastname; }

    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }

    public function getStatus() { return $this->status; }
    public function setStatus($status) { $this->status = $status; }

    public function getAge() { return $this->age; }
    public function setAge($age) { $this->age = $age; }
}

?>
