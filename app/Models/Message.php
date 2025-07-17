<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['body', 'chat_id', 'sender_id']; // возможно, нужно добавить id чата и отправителя

    public function chat(): BelongsTo{
        return $this->belongsTo(Chat::class);

    }
    public function sender(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function attachmnets(): HasMany{
        return $this->hasMany(Attachment::class);
    }

    public function read(): hasMany{
        return $this->hasMany(ReadMessage::class);
    }
}
