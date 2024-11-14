<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IconProject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function iconTransaction()
    {
        return $this->hasMany(IconTransaction::class);
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($proyek) {
    //         $proyek->icontransactions()->delete();
    //     });
    // }
}
