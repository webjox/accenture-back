<?php


namespace app\controllers\api;

use app\models\Warehouse;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class WarehouseController extends ActiveController
{
    public $modelClass = Warehouse::class;

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
     *     path="/api/warehouse",
     *     summary="Найти все склады",
     *     tags={"Склады"},
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
     *     path="/api/warehouse/{id}",
     *     summary="Найти склады по id",
     *     tags={"Склады"},
     *         @OA\Parameter(
     *         description="ID склада",
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
     *   path="/api/warehouse/",
     *   tags={"Склады"},
     *   summary="Добавить склад",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="reception_points",
     *                   description="Данные о пунктах приема",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="volume",
     *                   description="Общий объем",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="fullness",
     *                   description="Процент наполненности",
     *                   type="int"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Put(
     *   path="/api/warehouse/{id}",
     *   tags={"Склады"},
     *   summary="Обновить склад",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="reception_points",
     *                   description="Данные о пунктах приема",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="volume",
     *                   description="Общий объем",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="fullness",
     *                   description="Процент наполненности",
     *                   type="int"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Delete (
     *     path="/api/warehouse/{id}",
     *     summary="Удалить склад по id",
     *     tags={"Склады"},
     *         @OA\Parameter(
     *         description="ID склада",
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
       $count = Warehouse::find()->count();
       Yii::$app->response->headers->set('X-Total-Count', $count);
       $array =  Warehouse::find()->orderBy([$_sort => $_order === "ASC"?SORT_ASC:SORT_DESC])->all();
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
