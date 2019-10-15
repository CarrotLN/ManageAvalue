<?php

namespace App\Http\Controllers;

use App\Model\FolderSalary;
use App\Model\OtherSalary;
use App\Model\SalaryDetail;
use App\Model\Bank;
use App\Model\Employee;
use App\Model\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FolderSalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $folder_salaries = FolderSalary::all();
        return view('salarys.index', compact('folder_salaries'));


        exit();

        $employeeQuery = Employee::with('salary')->get();
        $sum_salary = 0;

        foreach ($employeeQuery as $employee) {
            $sum_salary += $employee->salary->salary;
        }

        $folder_salaries = FolderSalary::all();

        return view('salarys.index', compact('folder_salaries'));
    }


    public function create()
    {
        return view('salarys.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        $employeeQuery = Employee::with('salary')->where('status', 1)->get();
        $sum_salary = 0;
        $sum_reduce = 0;

        foreach ($employeeQuery as $employee) {
            $sum_salary += $employee->salary->salary;
            $sum_reduce += $employee->salary->social_insurance;
        }

        $folderSalary = new FolderSalary;
        $folderSalary->sum_salary = $sum_salary;
        $folderSalary->sum_reduce = $sum_reduce;
        $folderSalary->month = $request->month;
        $folderSalary->year = $request->year;
        $folderSalary->save();
        $folderSalary_id = $folderSalary->id;


        foreach ($employeeQuery as $employee) {
            $salaryDetail = new SalaryDetail;
            $salaryDetail->employee_id = $employee->id;
            $salaryDetail->folder_id = $folderSalary_id;
            $salaryDetail->salary = $employee->salary->salary;
            $salaryDetail->social_insurance = $employee->salary->social_insurance;
            $salaryDetail->total = ($employee->salary->salary - $employee->salary->social_insurance);
            $salaryDetail->save();
        }

        return redirect()->route('salarys.index')
            ->with('success', 'Product created successfully.');
    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        FolderSalary::create($id->all());

        return redirect()->route('salarys.edit')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function salaryList(Request $request, $id)
    {

        $salaryList = SalaryDetail::with('employee')
            ->where('folder_id', $id)
            ->get();
        $folder_salaries = SalaryDetail::with('folderSalary')
            ->where('id', $id)
            ->get();
        $employeeSalary = SalaryDetail::with('employeeSalary')
            ->where('id', $id)
            ->get();

        $folder_salaries = FolderSalary::all();


        $data['month'] = $salaryList[0]->folderSalary->month;
        $data['year'] = $salaryList[0]->folderSalary->year;
        $data['salaryList'] = $salaryList;
        $data['folder_salaries'] = $folder_salaries;
        $data['employeeSalary'] = $employeeSalary;

        return view('salarys.list', $data);
    }

    public function salaryEdit(Request $request, $id)
    {

        $folder_salaries = FolderSalary::with('employee')
            ->where('id', $id)
            ->get();

        $salaryDetail = SalaryDetail::with(['employee.bank'])
            ->where('id', $id)
            ->first();

        $salaryList = SalaryDetail::with('employee')
            ->where('folder_id', $id)
            ->get();

        $otherSalary = SalaryDetail::with('otherSalary')
            ->where('id', $id)
            ->get();

        $data = [];
        $data['folder_salaries'] = $folder_salaries;
        $data['salaryDetail'] = $salaryDetail;
        $data['salaryList'] = $salaryList;
        $data['otherSalary'] = $otherSalary;


//        dd($request);

//        $employee_id =$otherSalary ->id;

//        foreach ($request->other as $other) {
//            $otherSalary = new OtherSalary;
//            $otherSalary->employee_id = $employee_id;
//            $otherSalary->amount = $other["amount"];
//            $otherSalary->detail = $other["detail"];
//            $otherSalary->type = $other["type"];
//        }
dd($otherSalary);
        return view('salarys.edit', $data);

    }

    public function updateStatusPayMent(Request $request)
    {
        SalaryDetail::where('id',$request->id)->update(['payment_status' => $request->status]);
    }

}
