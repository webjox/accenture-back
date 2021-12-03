<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workers".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $status
 * @property string|null $reception_point
 * @property int|null $type
 */
class Workers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reception_point'], 'safe'],
            [['type'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'reception_point' => 'Reception Point',
            'type' => 'Type',
        ];
    }
}
