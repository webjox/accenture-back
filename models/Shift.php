<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shift".
 *
 * @property int $id
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $orders
 * @property int|null $id_technologist
 * @property int|null $id_technician
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_start', 'date_end', 'orders'], 'safe'],
            [['id_technologist', 'id_technician'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'orders' => 'Orders',
            'id_technologist' => 'Id Technologist',
            'id_technician' => 'Id Technician',
        ];
    }
}
