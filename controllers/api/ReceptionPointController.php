<?php


namespace app\controllers\api;

use app\models\ReceptionPoint;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class ReceptionPointController extends ActiveController
{
    public $modelClass = ReceptionPoint::class;

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
     *     path="/api/reception-point",
     *     summary="Найти все пункты приема",
     *     tags={"Пункты приема"},
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
     *     path="/api/reception-point/{id}",
     *     summary="Найти пункт приема по id",
     *     tags={"Пункты приема"},
     *         @OA\Parameter(
     *         description="ID пунка приема",
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
     *   path="/api/reception-point/",
     *   tags={"Пункты приема"},
     *   summary="Добавить пункт приема",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="title",
     *                   description="Название",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="id_technologist",
     *                   description="Id технолога",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="id_technician",
     *                   description="Id техника",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="stream_url",
     *                   description="Ссылка на транслацию",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="queue_vagons",
     *                   description="Очередь вагонов",
     *                   type="json"
     *               ),
     *                @OA\Property(
     *                   property="id_order",
     *                   description="Id заказа",
     *                   type="integer"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Put(
     *   path="/api/reception-point/{id}",
     *   tags={"Пункты приема"},
     *   summary="Обновить пункт приема",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="title",
     *                   description="Название",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="id_technologist",
     *                   description="Id технолога",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="id_technician",
     *                   description="Id техника",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="stream_url",
     *                   description="Ссылка на транслацию",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="integer"
     *               ),
     *                @OA\Property(
     *                   property="queue_vagons",
     *                   description="Очередь вагонов",
     *                   type="json"
     *               ),
     *                @OA\Property(
     *                   property="id_order",
     *                   description="Id заказа",
     *                   type="integer"
     *               ),
     *           )
     *       )
     *   ),
     *   @OA\Response(response="200",description=""),
     * )
     */

    /**
     * @OA\Delete (
     *     path="/api/reception-point/{id}",
     *     summary="Удалить пункт приема по id",
     *     tags={"Пункты приема"},
     *         @OA\Parameter(
     *         description="ID пункта",
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
        $count = ReceptionPoint::find()->count();
        Yii::$app->response->headers->set('X-Total-Count', $count);
        $array =  ReceptionPoint::find()->orderBy([$_sort => $_order === "ASC"?SORT_ASC:SORT_DESC])->all();
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
