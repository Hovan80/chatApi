<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadMessage extends Model
{

    protected $table = 'read_messages';
    protected $fillable = ['user_id', 'message_id'];
    public $incrementing = false;
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
    ];

    public function message(){
        return $this->belongsTo(Message::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
