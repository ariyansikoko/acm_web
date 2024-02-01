<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['project', 'recipient'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('description', 'like', '%' . $search . '%')
                ->orWhere('amount', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%');
        });

        $query->when($filters['project'] ?? false, function ($query, $project) {
            return $query->whereHas('project', function ($query) use ($project) {
                $query->where('slug', $project);
            });
        });

        $query->when($filters['recipient'] ?? false, function ($query, $recipient) {
            return $query->whereHas('recipient', function ($query) use ($recipient) {
                $query->where('slug', $recipient);
            });
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function getRouteKeyName()
    {
        return 'expense_id';
    }
}
