<?php

namespace App\Utils;

use Emarref\Jwt\Claim\Expiration;
use Emarref\Jwt\Claim\PublicClaim;

use Emarref\Jwt\ClaimInterface;
use Emarref\Jwt\Token;
use Emarref\Jwt\Algorithm\Hs256;
use Emarref\Jwt\Encryption\Factory;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Verification\Context;
use Exception;
use App\Exceptions\GlobalException;

class JWTHelper {

    public static function buildToken(array $payload, string $exp) {
        $token = new Token();
        foreach($payload as $k=>$v) {
            $pc = new PublicClaim($k, $v);
            $token->addClaim($pc);
        }
        $token->addClaim(new Expiration(new \DateTime($exp)));
        return $token;
    }

    public static function buildEncryption() {
        $privateKey = env("JWT_PRIVATE_KEY", "");
        $algorithm = new Hs256($privateKey);
        $encryption = Factory::create($algorithm);
        return $encryption;
    }

    public static function encode(array $payload): string {
        $JWT_RXPIRATION = env("JWT_RXPIRATION", "")." minutes";
        $token = JWTHelper::buildToken($payload, $JWT_RXPIRATION);
        $jwt = new Jwt();
        $encryption = JWTHelper::buildEncryption();
        $serializedToken = $jwt->serialize($token, $encryption);
        return $serializedToken;
    }

    public static function decode($token) {
        $jwt = new Jwt();
        $tokenObj = $jwt->deserialize($token);
        return $tokenObj;
    }

    public static function verify(Token $token) {
        $encryption = JWTHelper::buildEncryption();
        $context = new Context($encryption);
        $jwt = new Jwt();

        try {
            $res = $jwt->verify($token, $context);
            return $res;
        } catch (Exception $e) {
            throw new GlobalException($e->getMessage());
        }

    }
}