<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['text']; // возможно, нужно добавить id чата и отправителя

    public function chat(): BelongsTo{
        return $this->belongsTo(Chat::class);

    }
    public function sender(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function attachmnets(): HasMany{
        return $this->hasMany(Attachment::class);
    }
}
