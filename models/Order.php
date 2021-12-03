<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $number_vagon
 * @property float|null $weight
 * @property string|null $date
 * @property int|null $status
 * @property int|null $defect_percent
 * @property int|null $defect_weight
 * @property string|null $vagons
 * @property int|null $id_warehouse
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_vagon', 'status', 'defect_percent', 'defect_weight', 'id_warehouse'], 'integer'],
            [['weight'], 'number'],
            [['date', 'vagons'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_vagon' => 'Number Vagon',
            'weight' => 'Weight',
            'date' => 'Date',
            'status' => 'Status',
            'defect_percent' => 'Defect Percent',
            'defect_weight' => 'Defect Weight',
            'vagons' => 'Vagons',
            'id_warehouse' => 'Id Warehouse',
        ];
    }
}
