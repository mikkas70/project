<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    protected $table = 'tags';

    public function project_tag(){
        return $this->belongsTo('App\ProjectTag');
    }
}