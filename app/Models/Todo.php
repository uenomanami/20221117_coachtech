<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    protected $fillable = ['content','tag_id','user_id'];

    public function tag()//追記
    {
      return $this->belongsTo('App\Models\Tag');
    
    }

}
