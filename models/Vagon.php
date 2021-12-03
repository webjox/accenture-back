<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vagon".
 *
 * @property int $id
 * @property string|null $auto_number
 * @property float|null $weight
 * @property int|null $status
 * @property string|null $fixation
 * @property int|null $id_technologist
 * @property int|null $id_technician
 * @property int|null $declared_rejection_rate
 * @property int|null $actual_scrap_rate
 * @property float|null $defect
 * @property float|null $pure_material
 * @property int|null $id_provider
 * @property int|null $id_reception_point
 */
class Vagon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vagon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight', 'defect', 'pure_material'], 'number'],
            [['status', 'id_technologist', 'id_technician', 'declared_rejection_rate', 'actual_scrap_rate', 'id_provider', 'id_reception_point'], 'integer'],
            [['fixation'], 'safe'],
            [['auto_number'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auto_number' => 'Auto Number',
            'weight' => 'Weight',
            'status' => 'Status',
            'fixation' => 'Fixation',
            'id_technologist' => 'Id Technologist',
            'id_technician' => 'Id Technician',
            'declared_rejection_rate' => 'Declared Rejection Rate',
            'actual_scrap_rate' => 'Actual Scrap Rate',
            'defect' => 'Defect',
            'pure_material' => 'Pure Material',
            'id_provider' => 'Id Provider',
            'id_reception_point' => 'Id Reception Point',
        ];
    }
}
