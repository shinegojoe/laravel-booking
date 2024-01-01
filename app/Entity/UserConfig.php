<?php

namespace App\Entity;

class UserConfig {


    public $id;
    public $userId;
    public $isActivate;
    public $isDefaultCoach;
    public $isSyncCalendar;
    public $googleAuthCode;
    public $picture;

    public function __construct($body) {
        $this->userId = $body["userId"];
        $this->isActivate = $body["isActivate"];
        $this->isDefaultCoach = $body["isDefaultCoach"];
        $this->isSyncCalendar = $body["isSyncCalendar"];
        $this->googleAuthCode = $body["googleAuthCode"];
        $this->picture = $body["picture"];

    }
}

