<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected  $visible = [
    'id', 'title','go_date','return_date'
    ];

    
    public function owner()
    {
      return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /**
     * リレーションシップ - eventテーブル
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Event')->orderBy('id', 'desc');
    }
}
