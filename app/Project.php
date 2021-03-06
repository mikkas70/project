<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	public function user(){
		return $this->belongsTo('App\User');
	}

    public function media(){
        return $this->hasMany('App\Media');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function project_tags(){
        return $this->hasMany('App\ProjectTag');
    }
}
