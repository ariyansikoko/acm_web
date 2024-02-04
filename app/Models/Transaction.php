<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['project', 'recipient', 'expensetype'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Recipient::class);
    }

    public function expensetype()
    {
        return $this->belongsTo(Expensetype::class);
    }
}
