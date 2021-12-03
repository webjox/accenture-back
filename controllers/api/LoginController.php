<?php

namespace app\controllers\api;

use app\models\Users;
use app\models\JwtModel;
use app\models\UserRefreshTokens;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

class LoginController extends Controller
{
//    /**
//     * @inheritdoc
//     */
//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//            'optional' => [
//                'login',
//                'refresh-token'
//            ],
//        ];
//
//        return $behaviors;
//    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Аутентификация/Регистрация"},
     *   summary="Авторизация пользователя в систему",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="email",
     *                   description="E-mail пользователя",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="pass",
     *                   description="Пароль пользователя",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description="Авторизация прошла успешно"),
     * )
     */
    public function actionIndex()
    {
        $email = Yii::$app->request->post('email');
        $pass = Yii::$app->request->post('pass');

        $user = new Users();
        $login = $user->CheckUser($email, $pass);
        if ($login) {
            $result = $login->query;
            $jwt = new JwtModel();
            return $this->asJson($jwt->generateJwt($result));
        }

        return ['message' => "Неверный email или пароль"];
    }

    /**
     * @OA\Post(
     *   path="/api/login/refresh-token",
     *   tags={"Аутентификация/Регистрация"},
     *   summary="Сгенерировать новый рефреш токен пользователю",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="refresh_token",
     *                   description="Refresh token пользователя",
     *                   type="string"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */
    public function actionRefreshToken()
    {
        if (Yii::$app->request->isPost) {
            $refreshToken = Yii::$app->request->post('refresh_token');
            $userRefreshToken = UserRefreshTokens::findOne(['urf_token' => $refreshToken]);
            if ($userRefreshToken) {
                if ($userRefreshToken['available'] == 1) {
                    if (Yii::$app->request->getMethod() === 'POST') {
                        if (!$userRefreshToken) {
                            return new \yii\web\UnauthorizedHttpException('The refresh token no longer exists.');
                        }
                        $provider = new ActiveDataProvider([
                            'query' => Users::find()
                                ->where(['id' => $userRefreshToken->urf_userID])->asArray()->one(),
                        ]);
                        $result = $provider->query;
                        $jwt = new JwtModel();
                        $token = $jwt->generateJwt($result);
                        $userRefreshToken->available = 0;
                        $userRefreshToken->save();
                        return $token;
                    }
                } else {
                    return ['status' => 'Token expired'];
                }
            }
        }
    }

}
