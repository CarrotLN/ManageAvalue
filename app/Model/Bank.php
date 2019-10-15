<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function employees()
    {
        return $this->hasMany(Employee::class, 'bank_id', 'id');
    }
}
