<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('boq_desc', 'like', '%' . $search . '%')
                ->orWhere('boq_plan', 'like', '%' . $search . '%');
        });
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
