<?php

namespace app\controllers;

use yii\console\Controller;
use Yii;
use function OpenApi\scan;

class SwaggerController extends Controller
{

    /**
     * @OA\Info(
     *   title="Accencture API",
     *   version="1.0.0",
     *   @OA\Contact(
     *     email="vlad.veresklya@yandex.ru"
     *
     *   )
     * )
     */
    public function actionGo()
    {
        $openApi = scan(Yii::getAlias('@app/controllers'));
        $file = Yii::getAlias('@app/web/doc/swagger.yaml');
        $handle = fopen($file, 'wb');
        fwrite($handle, $openApi->toYaml());
        fclose($handle);
        return ;
    }

}
