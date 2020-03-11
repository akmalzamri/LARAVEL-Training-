<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // assign untuk tarik data dri table user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
