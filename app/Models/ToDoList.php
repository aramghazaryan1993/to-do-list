<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function tag()
    {
        return $this->belongsToMany(Tag::class,'user_tag_rels')
            ->withTimestamps();
    }
}
