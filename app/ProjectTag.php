<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTag extends Model {

    public function project(){
        return $this->has('App\Project');
    }

    public function tag(){
        return $this->has('App\Tag');
    }
}