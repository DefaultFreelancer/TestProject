<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{

    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdBy()
    {
        return $this->hasOne(User::class);
    }
}
