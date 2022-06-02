<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $username;
    public $email;
    public $name;
    public $surename;
    public $patronymic = '';
    public $gender;
    public $date_of_birth;
    public $organisation;
    public $role;
    public $password;
    public $password_repeat;
    public $rules = False;



    public function rules()
    {
        return [
            [['username', 'email', 'name', 'surename', 'gender', 'date_of_birth', 'organisation', 'role', 'password', 'password_repeat'], 'required'],
            // [['gender'], 'integer'],
            [['date_of_birth'], 'safe'],
            [['username'], 'string', 'max' => 30, 'min' => 6],
            [['email', 'organisation', 'role', 'password'], 'string', 'max' => 255],
            [['name', 'surename', 'patronymic'], 'string', 'max' => 50],
            ['password', 'string', 'min' => 9, 'tooShort'=>'Пароль должен сожержать не менее 9 символов'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают'],
            ['email', 'unique',  'targetClass' => User::class,  'message' => 'Эта почта уже занята'],
            ['username', 'unique',  'targetClass' => User::class,  'message' => 'Этот логин уже занят. Попробуйте другой'],
            ['rules', 'boolean'],
            ['rules', 'compare', 'compareValue'=>True, 'message'=>'Для регистрации необходимо принять соглашение.'],
            ['username', 'match', 'pattern'=>'/^[A-z0-9\-]*$/u', 'message'=>'Могут быть использованы символы латиницы, цифры и знак "-"'],
            [['name', 'surename', 'patronymic'], 'match', 'pattern'=>'/^[А-яё\-]*$/u', 'message'=>'Могут быть использованы символы кирилицы и знак "-"'],
            ['email', 'match', 'pattern'=>'/^[a-z0-9\-\._@]*$/u', 'message'=>'Могут быть использованы символы латиницы, цифры и знаки "-", "@", "_" и "."'],
            ['password', 'match', 'pattern'=>'/^[^\s]*$/u', 'message'=>'Пароль не должен содержать пробелы'],
            [['email', 'username', 'surename', 'organisation', 'name', 'patronymic', 'date_of_birth'], 'trim'],

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
            'role'=>'Тип пользователя',
            'password' => 'Пароль',
            'password_repeat' => 'Повторите пароль',
        ];
    }
}
