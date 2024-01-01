<?php
namespace App\VO;

use App\Entity\User;
use App\Entity\UserConfig;

class UserVO {
    public User $user;
    public UserConfig $userConfig;

    public string $token;
    public int $exp;
    public function __construct(User $user, UserConfig $userConfig, string $token, int $exp) {
        $this->user = $user;
        $this->userConfig = $userConfig;
        $this->token = $token;
        $this->exp = $exp;
    }
}