<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    public $table = "employee_salary";

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
        return $this->belongsTo(SalaryDetail::class, 'employee_id',"id");
    }
}
