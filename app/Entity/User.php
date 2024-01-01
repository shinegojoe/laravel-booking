<?php

namespace App\Entity;

class User {
    public $id;
    public $name;
    public $email;
    public $createTime;

    public function __construct($body) {
        $this->name = $body["name"];
        $this->email = $body["email"];
        $this->createTime = time();
    }
}

