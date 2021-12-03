<?php


namespace app\controllers\api;

use app\models\Vagon;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class VagonController extends ActiveController
{
    public $modelClass = Vagon::class;

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
     *     path="/api/vagon",
     *     summary="Найти все вагоны",
     *     tags={"Вагоны"},
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
     *     path="/api/vagon/{id}",
     *     summary="Найти вагоны по id",
     *     tags={"Вагоны"},
     *         @OA\Parameter(
     *         description="ID вагона",
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
     *   path="/api/vagon/",
     *   tags={"Вагоны"},
     *   summary="Добавить вагон",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="auto_number",
     *                   description="Номер вагона",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="weight",
     *                   description="Вес",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="fixation",
     *                   description="Фиксированные данные",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="id_technologist",
     *                   description="Id технолога",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="id_technician",
     *                   description="Id техника",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="declared_rejection_rate",
     *                   description="Заявленный процент брака (дельта)",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="actual_scrap_rate",
     *                   description="Фактический процент брака ( дельта факт)",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="defect",
     *                   description="Брак в тоннах ",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="pure_material",
     *                   description="Чистое сырьё без брака",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="id_provider",
     *                   description="Id поставщика",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="id_reception_point",
     *                   description="Id пункт приёма",
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
     *   path="/api/vagon/{id}",
     *   tags={"Вагоны"},
     *   summary="Обновить вагон",
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="auto_number",
     *                   description="Номер вагона",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="weight",
     *                   description="Вес",
     *                   type="string"
     *               ),
     *              @OA\Property(
     *                   property="status",
     *                   description="Статус",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="fixation",
     *                   description="Фиксированные данные",
     *                   type="json"
     *               ),
     *              @OA\Property(
     *                   property="id_technologist",
     *                   description="Id технолога",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="id_technician",
     *                   description="Id техника",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="declared_rejection_rate",
     *                   description="Заявленный процент брака (дельта)",
     *                   type="integer"
     *               ),
     *              @OA\Property(
     *                   property="actual_scrap_rate",
     *                   description="Фактический процент брака ( дельта факт)",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="defect",
     *                   description="Брак в тоннах ",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="pure_material",
     *                   description="Чистое сырьё без брака",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   property="id_provider",
     *                   description="Id поставщика",
     *                   type="integer"
     *               ),
     *               @OA\Property(
     *                   property="id_reception_point",
     *                   description="Id пункт приёма",
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
     *     path="/api/vagon/{id}",
     *     summary="Удалить вагон по id",
     *     tags={"Вагоны"},
     *         @OA\Parameter(
     *         description="ID вагона",
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
        $count = Vagon::find()->count();
        Yii::$app->response->headers->set('X-Total-Count', $count);
        $array =  Vagon::find()->orderBy([$_sort => $_order === "ASC"?SORT_ASC:SORT_DESC])->all();
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
