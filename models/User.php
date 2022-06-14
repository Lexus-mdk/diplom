<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $username
 * @property string $email
 * @property string $name
 * @property string $surename
 * @property string $patronymic
 * @property string $gender
 * @property string $date_of_birth
 * @property string $organisation
 * @property string $role
 * @property string $password
 * 
 * @property Likes[] $likes
 * @property RequestToTeam[] $requestToTeams
 * @property TeamMembers[] $teamMembers
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    public $accessToken;
    public $password_repeat;    

    public function rules()
    {
        return [
            [['username', 'email', 'name', 'surename', 'gender', 'date_of_birth', 'organisation', 'role', 'password'], 'required'],
            [['date_of_birth'], 'safe'],
            [['username'], 'string', 'max' => 15],
            [['email', 'organisation', 'role', 'password'], 'string', 'max' => 255],
            [['name', 'surename', 'patronymic'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rules' => 'Соглашаюсь с условиями регистрации',
            'username' => 'Логин',
            'email' => 'Почта',
            'name' => 'Имя',
            'surename' => 'Фамилия',
            'patronymic' => 'Отчество (необязательное поле)',
            'gender' => 'Пол',
            'date_of_birth' => 'Дата рождения',
            'organisation' => 'Образовательное учреждение/организация',
            'role'=>'Тип пользователя'
        ];
    }


    /**
     * Gets query for [[RequestToTeams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestToTeams()
    {
        return $this->hasMany(RequestToTeam::class, ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[TeamMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamMembers()
    {
        return $this->hasMany(TeamMembers::class, ['user_id' => 'user_id']);
    }

    public static function tableName()
    {
        return 'user';
    }

    public function createAuthKey()
    {
        return \Yii::$app->security->generateRandomString(12);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->user_id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}