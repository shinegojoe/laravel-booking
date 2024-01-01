<?php
namespace App\VO;

use App\Models\User;
use App\Models\UserConfig;

class UserVO {
    public User $user;
    public UserConfig $userConfig;

    public string $token;
    public int $exp;
    
}