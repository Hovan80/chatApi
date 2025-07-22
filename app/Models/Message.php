<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $table = 'messages';

    protected $fillable = ['chat_id', 'user_id', 'body'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
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
