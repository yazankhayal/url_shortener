<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class URL extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "url";

    protected $fillable = [
        'code', 'link','name'
    ];

    public function URLViewCount(){
        return $this->hasMany(URLView::class,"url_id","id");
    }

}
