<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $project_id
 * @property string $name
 * @property string $st_description
 * @property string $description
 * @property string|null $links
 * @property int $team_members_count
 * @property int $finding
 * @property int $like
 * @property int $subscription
 * @property string $status
 * @property string $date
 * @property int $creator_id
 *
 * @property User $creator
 * @property FindingTeamMembers[] $findingTeamMembers
 * @property TeamMembers[] $teamMembers
 */
class Projects extends \yii\db\ActiveRecord
{
        // public $project_id;
        // public $name;
        // public $st_description;
        // public $description;
        // public $links;
        // public $team_members_count;
        // public $finding;
        // public $like;
        // public $subscription;
        // public $status;
        // public $date;
        // public $creator_id;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'st_description', 'description', 'status', 'date', 'creator_id'], 'required'],
            [['links', 'date'], 'safe'],
            [['like', 'subscription', 'creator_id'], 'integer'],
            [['name', 'st_description', 'status'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['creator_id' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Идентификатор проекта',
            'name' => 'Название',
            'st_description' => 'Краткое описание',
            'description' => 'Описание',
            'links' => 'Ссылки',
            'team_members_count' => 'Количество участников',
            'like' => 'Нравится',
            'subscription' => 'Подписки',
            'status' => 'Статус',
            'date' => 'Дата создания',
            'creator_id' => 'Идентификатор создателя',
        ];
    }

    /**
     * Gets query for [[Creator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::class, ['user_id' => 'creator_id']);
    }

    /**
     * Gets query for [[FindingTeamMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFindingTeamMembers()
    {
        return $this->hasMany(FindingTeamMembers::class, ['project_id' => 'project_id']);
    }

    /**
     * Gets query for [[TeamMembers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamMembers()
    {
        return $this->hasMany(TeamMembers::class, ['project_id' => 'project_id']);
    }
}
