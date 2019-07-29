<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    // public $timestamps = false;

    public function projects()
    {
        return $this->belongsTo(User::class);
    }
}
