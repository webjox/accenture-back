<?php


namespace app\controllers\api;

use app\models\Material;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class MaterialController extends ActiveController
{
    public $modelClass = Material::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET','DELETE'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['Content-Type'],
                'Access-Control-Max-Age' => 3600,
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

    /**
     * @OA\Get(
     *     path="/api/material",
     *     summary="Найти все сырье",
     *     tags={"Сырье"},
     *         @OA\Parameter(
     *         description="Кол-во записей на странице",
     *         in="query",
     *         name="per-page",
     *         required=false,
     *         @OA\Schema(
     *           type="integer",
     *         )
     *       ),
     *         @OA\Parameter(
     *         description="Номер страницы",
     *         in="query",
     *         name="page",
     *         required=false,
     *         @OA\Schema(
     *           type="integer",
     *         )
     *       ),
     *     @OA\Response(response="200", description="Success")
     * )
     */

    /**
     * @OA\Get(
     *     path="/api/material/{id}",
     *     summary="Найти сырье по id",
     *     tags={"Сырье"},
     *         @OA\Parameter(
     *         description="ID сырья",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success")
     * )
     */

    /**
     * @OA\Post(
     *   path="/api/material/",
     *   tags={"Сырье"},
     *   summary="Добавить сырье",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="title",
     *                   description="Название сырья",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="defect_frequency",
     *                   description="Частота брака",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="delta",
     *                   description="Дельта",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="dataset",
     *                   description="Датасет",
     *                   type="json"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Put(
     *   path="/api/material/{id}",
     *   tags={"Сырье"},
     *   summary="Обновить сырье",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="title",
     *                   description="Название сырья",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="defect_frequency",
     *                   description="Частота брака",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="delta",
     *                   description="Дельта",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="dataset",
     *                   description="Датасет",
     *                   type="json"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Delete (
     *     path="/api/material/{id}",
     *     summary="Удалить сырье по id",
     *     tags={"Сырье"},
     *         @OA\Parameter(
     *         description="ID сырья",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(response="200", description="Success")
     * )
     * @param $_order
     * @param $_sort
     * @param $_start
     * @param $_end
     * @return array|\yii\db\ActiveRecord[]
     */

    public function actionIndex($_order, $_sort, $_start,$_end){
        $count = Material::find()->count();
        Yii::$app->response->headers->set('X-Total-Count', $count);
        $array =  Material::find()->orderBy([$_sort => $_order === "ASC"?SORT_ASC:SORT_DESC])->all();
        if($_end>$count) $_end = $count;
        for ($i=$_start;$i<=$_end-1;$i++){
            $new_array[] = $array[$i];
        }
        if (isset($new_array)) return $new_array;
        else return null;
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['index']['dataFilter'] = [
            'class' => \yii\data\ActiveDataFilter::class,
            'searchModel' => $this->modelClass,
        ];

        unset($actions['index']);

        return $actions;
    }

}
