<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    protected $table = 'attachments';
    protected $fillable = ['file_name, uploader_id'];

    public function sender(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function message(): BelongsTo{
        return $this->belongsTo(Message::class);
    }
}
