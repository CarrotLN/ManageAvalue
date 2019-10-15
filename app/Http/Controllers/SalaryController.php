<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use App\Model\EmployeeSalary;
use App\Model\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $employeeQuery = Employee::with('salary')->get();
        $sum_salary = 0;

        foreach ($employeeQuery as $employee){
            $sum_salary += $employee->salary->salary;
        }


        //save database reture id
//        dd($sum_salary);



        return view('salarys.index', compact('salarys'));
    }


    public function create()
    {
        return view('salarys.create', compact('banks'));
    }


    public function store(Request $request)
    {
        $folder_salary = new Salary;
        $folder_salary->month = $request->month;
        $folder_salary->year = $request->year;
        $folder_salary->save();

        return redirect()->route('salarys.index')->with('success', 'Employee created successfully.');


    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
