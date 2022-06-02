<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_to_team".
 *
 * @property int $id
 * @property int $user_id
 * @property int $vacancy_id
 * @property string $message
 *
 * @property User $user
 * @property FindingTeamMembers $vacancy
 */
class RequestToTeam extends \yii\db\ActiveRecord
{
        // public $id;
        // public $user_id;
        // public $vacancy_id;
        // public $message;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_to_team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'vacancy_id', 'message'], 'required'],
            [['user_id', 'vacancy_id'], 'integer'],
            [['message'], 'string', 'max' => 500],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'user_id']],
            [['vacancy_id'], 'exist', 'skipOnError' => true, 'targetClass' => FindingTeamMembers::class, 'targetAttribute' => ['vacancy_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'vacancy_id' => 'Vacancy ID',
            'message' => 'Сопроводительное письмо',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }

    /**
     * Gets query for [[Vacancy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancy()
    {
        return $this->hasOne(FindingTeamMembers::className(), ['id' => 'vacancy_id']);
    }
}
