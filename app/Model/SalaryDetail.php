<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    public $table = "employee_salary_detail";

    protected $fillable = [
        'rate',
        'rate_time',
        'sum_ot',
        'total',

    ];
    public function employee(){
        return $this->belongsTo(Employee::class,"employee_id","id");
    }
    public function otherSalary(){
        return $this->belongsTo(OtherSalary::class,"employee_id","id");
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
        return $this->belongsTo(EmployeeSalary::class, 'folder_id',"id");
    }
}
