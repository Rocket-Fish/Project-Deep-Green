<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // guard the sensitive uneditable data
    protected $guarded = ['id', 'created_at', 'updated_at'];
    // we only have a select few that needs protecting atm, if
    // we have mostly protected stuff then we should use $fillable instead
}
