<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model {

    protected $table = 'project_tag';

    public function project(){
        return $this->hasOne('App\Project');
    }

    public function tag(){
        return $this->hasOne('App\Tag');
    }
}