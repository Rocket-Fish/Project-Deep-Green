<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // guard the sensitive uneditable data
    protected $guarded = ['id', 'created_at', 'updated_at'];
    // if we want protected use $fillable instead
}
