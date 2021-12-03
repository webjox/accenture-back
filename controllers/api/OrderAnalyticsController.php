<?php


namespace app\controllers\api;

use app\models\Order;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class OrderAnalyticsController extends ActiveController
{
    public $modelClass = Order::class;

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
     *     path="/api/order",
     *     summary="Найти все заказы",
     *     tags={"Заказы"},
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
     *     path="/api/order/{id}",
     *     summary="Найти заказы по id",
     *     tags={"Заказы"},
     *         @OA\Parameter(
     *         description="ID заказа",
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
     *   path="/api/order/",
     *   tags={"Заказы"},
     *   summary="Добавить заказ",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="number_vagon",
     *                   description="Кол-во вагонов",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="weight",
     *                   description="Кол-во тонн",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="date",
     *                   description="Дата",
     *                   type="date"
     *               ),
     *                @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="defect_percent",
     *                   description="Процент брака",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="defect_weight",
     *                   description="Вес брака",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="vagons",
     *                   description="Вагоны",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="id_warehouse",
     *                   description="Id склада",
     *                   type="integer"
     *               ),
     *
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Put(
     *   path="/api/order/{id}",
     *   tags={"Заказы"},
     *   summary="Обновить заказ",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="number_vagon",
     *                   description="Кол-во вагонов",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="weight",
     *                   description="Кол-во тонн",
     *                   type="double"
     *               ),
     *              @OA\Property(
     *                   property="date",
     *                   description="Дата",
     *                   type="date"
     *               ),
     *                @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="defect_percent",
     *                   description="Процент брака",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="defect_weight",
     *                   description="Вес брака",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="vagons",
     *                   description="Вагоны",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="id_warehouse",
     *                   description="Id склада",
     *                   type="integer"
     *               ),
     *
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Delete (
     *     path="/api/order/{id}",
     *     summary="Удалить заказ по id",
     *     tags={"Заказы"},
     *         @OA\Parameter(
     *         description="ID заказа",
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
        $count = Order::find()->count();
        Yii::$app->response->headers->set('X-Total-Count', $count);
        $array =  Order::find()->orderBy([$_sort => $_order === "ASC"?SORT_ASC:SORT_DESC])->all();
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
