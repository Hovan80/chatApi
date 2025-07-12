<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    protected $table = 'systems';

    protected $fillable = ['name'];

    public function system(): HasMany{
        return $this->hasMany(System::class);
    }
}
