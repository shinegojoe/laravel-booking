<?php
namespace App\Utils;

class AppResponse {
    private $err;
    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function jsonSerialize()
    {
        return [
            'err' => $this->err,
            'data' => $this->data,
        ];
    }
}