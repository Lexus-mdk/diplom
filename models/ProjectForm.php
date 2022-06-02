<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Projects extends Model
{
    public $name;
    public $st_description;
    public $description;
    public $links;
    public $team_members_count;
    public $team_members;
    public $finding;
    public $like;
    public $subscription;
    public $status;

    
    public function rules()
    {
        return [
            [['name', 'st_description', 'description', 'team_members_count', 'team_members', 'status', 'date'], 'required'],
            [['links', 'team_members', 'date'], 'safe'],
            [['team_members_count', 'finding', 'like', 'subscription'], 'integer'],
            [['name', 'st_description', 'status'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 2000],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'st_description' => 'St Description',
            'description' => 'Description',
            'links' => 'Links',
            'team_members_count' => 'Team Members Count',
            'team_members' => 'Team Members',
            'finding' => 'Finding',
            'like' => 'Like',
            'subscription' => 'Subscription',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
