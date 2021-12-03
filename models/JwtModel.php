<?php

namespace app\models;

use sizeg\jwt\Jwt;
use Yii;
use yii\base\Model;
use yii\web\Cookie;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class JwtModel extends Model
{

    private function generateToken($result,$time){
        $signer = new \Lcobucci\JWT\Signer\Hmac\Sha256();
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $token = $jwt->getBuilder()
            ->setIssuer('http://example.com')// Configures the issuer (iss claim)
            ->setAudience('http://example.org')// Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true)// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
            ->setExpiration(time() + $time)// Configures the expiration time of the token (exp claim)
            ->set('uid', $result)// Configures a new claim, called "uid"
            ->sign($signer, $jwt->key)// creates a signature using [[Jwt::$key]]
            ->getToken(); // Retrieves the generated token
        return $token;
    }

    public function generateJwt($result)
    {
        $token = $this->generateToken($result['id'],360);
        $refresh = $this->generateRefreshToken($result['id'],60*60*24*30);
        return ([
            'status' => true,
            'message' => 'Generate token success',
            'token' => (string)$token,
            'user' => $result,
            'refresh' => $refresh
        ]);
    }

    private function generateRefreshToken($user, $time): UserRefreshTokens
    {
        $refreshToken = $this->generateToken($user,$time);
        $userRefreshToken = new UserRefreshTokens([
            'urf_userID' => $user,
            'urf_token' => (string)$refreshToken,
            'urf_ip' => Yii::$app->request->userIP,
            'urf_user_agent' => Yii::$app->request->userAgent,
            'urf_created' => date('Y-m-d H:i:s'),
        ]);
        if (!$userRefreshToken->save()) {
            throw new \yii\web\ServerErrorHttpException('Failed to save the refresh token: ' . $userRefreshToken->getErrorSummary(true));
        }
        return $userRefreshToken;
    }

}
