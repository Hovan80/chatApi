<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMember extends Model
{
    use SoftDeletes;
    protected $table = "chat_members";
    protected $fillable = [
        'chat_id',
        'user_id',
        'is_admin',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at_at' => 'datetime',
        'deleted_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
