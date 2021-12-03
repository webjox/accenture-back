<?php


namespace app\controllers\api;

use app\models\Vagon;
use app\models\Workers;
use sizeg\jwt\JwtHttpBearerAuth;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class DashBoardController extends Controller
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET', 'DELETE'],
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
     *     path="/api/dash-board",
     *     summary="Вся информация для дашборда",
     *     tags={"Дашборд"},
     *         @OA\Parameter(
     *         description="Id диспетчера",
     *         in="query",
     *         name="id",
     *         required=false,
     *         @OA\Schema(
     *           type="integer",
     *         )
     *       ),
     *     @OA\Response(response="200", description="Success")
     * )
     */

    public function actionIndex($id){
        return Vagon::find()
            ->select(['id_reception_point','fixation','declared_rejection_rate','actual_scrap_rate','auto_number'])
            ->where(['id_technologist'=>$id])->all();
    }



}
