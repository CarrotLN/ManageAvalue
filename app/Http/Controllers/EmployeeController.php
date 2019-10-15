<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Employee;
use App\Model\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $employees = Employee::with('salaryList');
        if (!empty($search)) {
            $employees = $employees->where(function ($query) use ($search) {
                $query->orWhere('name', 'like', '%' . $search . '%');
            });
        }
        $employeeList = $employees->get();
        //dd($employeeList);

        //$employees = Employee::where('name', 'like', '%'.$search.'%');
        return view('employees.index', ['employees' => $employeeList]);
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $employeeQuery = Employee::with('salaryList');

        if (!empty($search)) {
            $employeeQuery = $employeeQuery->where(function ($query) use ($search) {
                $query->Where('name', 'like', '%' . $search . '%');
                $query->orWhere('surname', 'like', '%' . $search . '%');
                $query->orWhere('position', 'like', '%' . $search . '%');
            });
        }

        $employees = $employeeQuery->get();

        $today = date('Y-m-d');
        foreach ($employees as $key => $employee) {
            $salary = $employee->salaryList->Where('salary_date', "<=", $today)->first();
            $employees[$key]["salary"] = Optional($salary)->salary ?? 0;
        }


        return view('employees.index', compact('employees'));
    }


    public function create()
    {

        $banks = Bank::all()->pluck('name', 'id')->prepend(trans('PleaseSelect Bank'), '');

        return view('employees.create', compact('banks'));
    }

    public function result(Request $request)
    {
        $result = Employee::where('name', 'LIKE', "%{$request->input('query')}%")->get();
        return response()->json($result);
    }


    public function store(Request $request)
    {
//        if ($request->hasFile('image')) {
//            dd(1);
//        }
//        exit();


        $y = $request->y;
        $m = $request->m;
        $d = $request->d;

        $birthday = $y . "-" . $m . "-" . $d;

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->surname = $request->surname;
        $employee->id_card = $request->id_card;
        $employee->address = $request->address;
        $employee->tel = $request->tel;
        $employee->email = $request->email;
        $employee->position = $request->position;
        $employee->social_insurance_no = $request->social_insurance_no;
        $employee->bank_id = $request->bank_id;
        $employee->account_no = $request->account_no;
        $employee->status = $request->status;
        $employee->birthday = $birthday;
        $employee->save();
        $employee_id = $employee->id;

//        $filepath = 'upload/user/'.$employee_id;
//        if (!File::exists($filepath)) {
//            File::makeDirectory($filepath, 0775, true);
//        }
//
////        $fullPathImage = 'images/sine.jpg';
////        if ($request->hasFile('image')) {
////            $random = bin2hex(random_bytes(2));
////            $filename = time(). $random.".png";
////
////            $file = $request->file('image');
////            $file->move($filepath, $filename);
////            $fullPathImage = $filepath."/".$filename;
////        }
//////        Employee::where('id','$employee_id')->update('image',$fullPathImage);



        foreach ($request->salary as $salary) {
            $social_insurance = 0.05;
            $employeeSalary = new EmployeeSalary;
            $employeeSalary->employee_id = $employee_id;
            $employeeSalary->salary = $salary["amount"];
            $employeeSalary->salary_date = $salary["date"];
            $employeeSalary->social_insurance = $salary["amount"] * $social_insurance;

            $employeeSalary->save();
        }
//        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');

    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employees'));
    }


    public function edit(Employee $employee)
    {


        $banks = Bank::all()->pluck('name', 'id')->prepend(trans('PleaseSelect Bank'), '');
        $employee->load('salaryList');
        return view('employees.edit', compact('employee', 'banks'));
    }


    public function update(Request $request, Employee $employee)
    {

//        $filepath = 'upload/user/'.$employee->id;
//        if (!File::exists($filepath)) {
//            File::makeDirectory($filepath, 0775, true);
//        }
//
//        if ($request->hasFile('image')) {
//            $file = $request->file('image');
//            File::delete($employee->image);
//
//            $random = bin2hex(random_bytes(2));
//            $filename = time(). $random.".png";
//
//            $file->move($filepath, $filename);
//            $fullPathImage = $filepath."/".$filename;
//
//            Employee::where('id',$employee->id)->update('image',$fullPathImage);
//            dd('success');
//        }
//
//        exit();
//        if ($request->hasFile('files')) {
//            $files = $request->file('files');
//            $querySlipImage =  SlipImage::where(['project_id' => $project_id,'task_id' => $task_id,
//                'slip_id' => $slip->id])->get();
//            foreach ($querySlipImage as $slipImage) {
//                $file_path = public_path($slipImage->file_path);
//                File::delete($file_path);
//            }
//            SlipImage::where(['project_id' => $project_id,'task_id' => $task_id,'slip_id'=>$slip->id])->delete();
//            foreach ($files as $key => $file) {
//                $random = bin2hex(random_bytes(2));
//                $filename = time(). $random.".png";
//                if ($file->move($filepath, $filename)) {
//                    $slipImage = new SlipImage;
//                    $slipImage->project_id = $project_id;
//                    $slipImage->task_id = $task_id;
//                    $slipImage->slip_id = $slip->id;
//                    $slipImage->file_path = $filepath."/".$filename;
//                    $slipImage->save();
//                }
//            }
//        }

//dd($employee);
//        exit();
//        dd($request->salary);


//        $y = $request->y;
//        $m = $request->m;
//        $d = $request->d;
//
//        $birthday = $y . "-" . $m . "-" . $d;
//
//        $employee = new Employee;
//        $employee->name = $request->name;
//        $employee->surname = $request->surname;
//        $employee->id_card = $request->id_card;
//        $employee->address = $request->address;
//        $employee->tel = $request->tel;
//        $employee->email = $request->email;
//        $employee->position = $request->position;
//        $employee->social_insurance = $request->social_insurance;
//        $employee->bank_id = $request->bank_id;
//        $employee->account_no = $request->account_no;
//        $employee->status = $request->status;
//        $employee->birthday = $birthday;
        $employee->save();
        $employee_id = $employee->id;

        EmployeeSalary::where('employee_id', $employee->id)->delete();

        foreach ($request->salary as $salary) {
            $social_insurance = 0.05;
            $employeeSalary = new EmployeeSalary;
            $employeeSalary->employee_id = $employee_id;
            $employeeSalary->salary = $salary["amount"];
            $employeeSalary->salary_date = $salary["date"];
            $employeeSalary->social_insurance = $salary["amount"] * $social_insurance;

            $employeeSalary->save();
        }

        return redirect()->route('employees.index')->with('success', 'Employees updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request){
        Employee::where('id',$request->id)->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

    public function destroy(Employee $employee)
    {

        Employee::where('id',$employee->id)->delete();

//        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }

}
