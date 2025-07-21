<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ChatGroup extends Model
{
    protected $table = 'chat_groups';
    protected $fillable = ['title'];

    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

}
