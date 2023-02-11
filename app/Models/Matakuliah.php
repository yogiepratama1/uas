<?php

namespace App\Models;

use App\Models\Nilai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Matakuliah extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
