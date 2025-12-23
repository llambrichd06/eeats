<?php

class User {
    private $id;
    private $name;
    private $email;
    private $profile_picture;
    private $password;
    private $role;
    private $premium;

    public function setData(
        $name = null,
        $email = null,
        $profile_picture = null, 
        $password = null, 
        $role = null, 
        $premium = null, 
        $id = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->profile_picture = $profile_picture;
        $this->password = $password;
        $this->role = $role;
        $this->premium = $premium;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function getProfilePicture() {
        return $this->profile_picture;
    }

    public function setProfilePicture($profile_picture) {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    public function getPremium() {
        return $this->premium;
    }

    public function setPremium($premium) {
        // $return = false;
        // if ($premium == 1) $return = true;
        $this->premium = $premium;
        return $this;
    }

    public function toArray() {
        return get_object_vars($this);
    }
}
    