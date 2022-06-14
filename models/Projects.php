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
 *
 * @property FindingTeamMembers[] $findingTeamMembers
 * @property Likes[] $likes
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
        public $arr = [
            0=>'Модерация',
            1=>'Допущен',
            2=>'Требуются исправления',
            3=>'Заблокирован'
        ];
        public $color = [
            0=>'blue',
            1=>'green',
            2=>'orange',
            3=>'red'
        ];
        public $post;
        public $moder;

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
            [['name', 'st_description', 'description', 'status', 'date', 'post'], 'required'],
            [['links', 'date'], 'safe'],
            [['like'], 'integer'],
            [['name', 'st_description', 'status'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
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
            'status' => 'Статус',
            'date' => 'Дата создания',
            'post' => 'Ваша должность в проекте',
            'm_message' => 'Сообщение модератора',
            'moderation' => 'Статус модерации'
        ];
    }


    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['project_id' => 'project_id']);
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
