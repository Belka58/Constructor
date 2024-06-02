<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProgram extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'content' => 'array',
        ];
    }

    protected $guarded = false;
}
