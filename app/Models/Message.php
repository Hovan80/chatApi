<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['chat_id', 'user_id', 'body', 'is_deleted'];

    protected $casts = [
        'is_deleted' => 'boolean',
    ];

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
