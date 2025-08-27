<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $table = 'attachments';
    protected $fillable = ['guid, message_id'];

    public function message(): BelongsTo{
        return $this->belongsTo(Message::class);
    }
}
