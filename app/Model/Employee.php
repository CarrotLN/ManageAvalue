<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = "employees";

    protected $date = ["birthday"];
    protected $fillable = [
        'name',
        'surname',
        'id_card',
        'address',
        'tel',
        'email',
        'position',
        'salary',
        'social_insurance',
        'account_no',
        'bank_id',
        'salary_date',
        'birthday',
        'status',

    ];

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function salaryList()
    {
        return $this->hasMany(EmployeeSalary::class, 'employee_id',"id");
    }
    public function salary()
    {
        return $this->belongsTo('App\Model\EmployeeSalary', 'id', 'employee_id');
    }
}
