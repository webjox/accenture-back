<?php

namespace app\controllers\api;

use app\models\Users;
use app\models\JwtModel;
use app\models\UserRefreshTokens;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;

class TransportNumberController extends Controller
{
        /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
              'index'
            ],
        ];

        return $behaviors;
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * @OA\Post(
     *   path="/api/transport-number",
     *   tags={"Номер транспорта"},
     *   summary="Поиск номера транспорта на картинке",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="image",
     *                   description="Картинка транспорта",
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
     var_dump("here");
    }


}
