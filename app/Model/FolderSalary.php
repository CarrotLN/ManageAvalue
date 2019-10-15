<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FolderSalary extends Model
{
    public $table = "folder_salaries";


    protected $fillable = [
        'month', 'year'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class,"employee_id","id");
    }


    public function folderSalary(){
        return $this->belongsTo(FolderSalary::class,"folder_id","id");
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
    public function employeeSalary()
    {
        return $this->belongsTo(EmployeeSalary::class, 'employee_id',"id");
    }
}
