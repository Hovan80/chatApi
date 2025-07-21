<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    protected $table = "chats";
    protected $fillable = ["title, chat_type, chat_group_id"];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at' => 'datetime'
    ];

    public function chatGroup(): BelongsTo
    {
        return $this->belongsTo(ChatGroup::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function members(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

}
