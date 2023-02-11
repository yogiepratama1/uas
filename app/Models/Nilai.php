<?php

namespace App\Models;

use App\Models\User;
use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id', 'id');
    }
}
