<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatGroup extends Model
{
    use SoftDeletes;
    protected $table = 'chats_group';
    protected $fillable = ['title'];

    protected $casts = [
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($group) {
            $group->uuid = (string) Str::uuid();
        });
    }

    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

}
