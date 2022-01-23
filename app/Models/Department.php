<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'icon',
        'description',
        'keyword',
        'parent',
    ];

    public function parents(){
        return $this->hasMany('App\Models\Department' ,'id' ,'parent_id');
    }
}
