<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['login', 'password', 'system_id', 'display_name'];

    public function chats(): BelongsToMany{
        return $this->belongsToMany(Chat::class);
    }

    public function mesages(): BelongsToMany{
        return $this->belongsToMany(Message::class);
    }

    public function attachments(): HasMany{
        return $this->hasMany(Attachment::class);
    }

    public function read(): HasMany{
        return $this->hasMany(ReadMessage::class);
    }
}
