<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OtherSalary extends Model
{
    public $table = "other_salary";

    public function employeeSalary()
    {
        return $this->belongsTo(SalaryDetail::class, 'employee_id',"id");
    }
    public function employee(){
        return $this->belongsTo(Employee::class,"employee_id","id");
    }
    public function folderSalary(){
        return $this->belongsTo(FolderSalary::class,"folder_id","id");
    }
}
