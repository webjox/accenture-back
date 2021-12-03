<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reception_point".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $id_technologist
 * @property int|null $id_technician
 * @property string|null $stream_url
 * @property int|null $status
 * @property string|null $queue_vagons
 * @property int|null $id_order
 */
class ReceptionPoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reception_point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_technologist', 'id_technician', 'status', 'id_order'], 'integer'],
            [['queue_vagons'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['stream_url'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'id_technologist' => 'Id Technologist',
            'id_technician' => 'Id Technician',
            'stream_url' => 'Stream Url',
            'status' => 'Status',
            'queue_vagons' => 'Queue Vagons',
            'id_order' => 'Id Order',
        ];
    }
}
