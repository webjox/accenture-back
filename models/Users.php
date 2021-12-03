<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $password
 * @property int|null $is_admin
 * @property string|null $reset_pass_token
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_admin'], 'integer'],
            [['email','reset_pass_token','auth_key'], 'string', 'max' => 200],
            [['password'], 'string', 'max' => 120],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'E-mail',
            'password' => 'Пароль',
            'is_admin' => 'Админ',
        ];
    }

    public function CheckUser($email,$pass){
        $user = self::find()->where(['email'=>$email])->one();
        if(Yii::$app->security->validatePassword($pass,$user->password)){
        $provider = new ActiveDataProvider([
            'query' => self::find()
                ->where(['email' => $email])
                ->asArray()
                ->one(),
        ]);
    }
        if(isset($provider))
            return $provider;
    }

}
