<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "team_members".
 *
 * @property int $id
 * @property int $project_id
 * @property int $user_id
 * @property string $post
 *
 * @property Projects $project
 * @property User $user
 */
class TeamMembers extends \yii\db\ActiveRecord
{
        // public $id;
        // public $project_id;
        // public $user_id;
        // public $post;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'post'], 'required'],
            [['project_id', 'user_id'], 'integer'],
            [['post'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::class, 'targetAttribute' => ['project_id' => 'project_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'user_id' => 'Username (вы можете найти его на странице пользователя, под его полным именем)',
            'post' => 'Должность',
        ];
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['project_id' => 'project_id']);
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
}
