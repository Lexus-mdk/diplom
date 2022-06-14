<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "finding_team_members".
 *
 * @property int $id
 * @property int $project_id
 * @property string $description
 * @property string $post
 *
 * @property Projects $project
 * @property RequestToTeam[] $requestToTeams
 */
class FindingTeamMembers extends \yii\db\ActiveRecord
{
        // public $id;
        // public $project_id;
        // public $description;
        // public $post;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finding_team_members';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'description', 'post'], 'required'],
            [['project_id'], 'integer'],
            [['description'], 'string', 'max' => 300],
            [['post'], 'string', 'max' => 255],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::class, 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => '',
            'description' => 'Описание',
            'post' => 'Должность',
        ];
    }


    public function isInTeam()
    {
        $member = TeamMembers::findOne(['user_id'=>\Yii::$app->user->identity->user_id, 'project_id'=>$this->project_id]);
        if (!$member)
        {
            $vac = RequestToTeam::findOne(['vacancy_id'=>$this->id, 'user_id'=>\Yii::$app->user->identity->user_id]);
            if (!$vac)
            {
                return True;
            }
        }
        return False;
    }

    /**
     * Gets query for [[Project]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::class, ['project_id' => 'project_id']);
    }

    /**
     * Gets query for [[RequestToTeams]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestToTeams()
    {
        return $this->hasMany(RequestToTeam::class, ['vacancy_id' => 'id']);
    }
}
