<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
use yii\base\Model;
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public static function tableName(){
        return 'users';
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */


    /**
     * {@inheritdoc}
     * @param \Lcobucci\JWT\Token $token
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $user = User::find()->where(['id'=>$token->getClaim('uid')])->one();
        if($user){
            return $user;
        }

        return null;
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function getRole(){
        return $this->role;
    }

    public function generateAuthKey()
    {
        return $this->auth_key = rand();
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
        //return $password === $this->password;
    }


}
