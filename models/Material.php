<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property int $id
 * @property string|null $title
 * @property float|null $defect_frequency
 * @property float|null $delta
 * @property string|null $dataset
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['defect_frequency', 'delta'], 'number'],
            [['dataset'], 'safe'],
            [['title'], 'string', 'max' => 100],
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
            'defect_frequency' => 'Defect Frequency',
            'delta' => 'Delta',
            'dataset' => 'Dataset',
        ];
    }
}
