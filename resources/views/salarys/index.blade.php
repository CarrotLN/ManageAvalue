<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>Salary</title>
</head>

<body>
<div class="header">
    <img src="../../images/logo-home.svg" class="logo">
    <div class="employee-management">Salary Management</div>
    <a href="{{ route('logout') }}" class="logout"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <img src="../../images/logout.png" class="logout">
    </a>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
<div class="menu">
    <div class="box-menu">
        <div class="topic-menu">
            <p> MENU</p>
        </div>
        <div class="section-menu">
            <a href="{{ route("home") }}" class="menu-detail">
                <div class="icon-menu3">
                    <p class="text-menu">Statics</p>
                </div>
            </a>
            <a href="{{ route("employees.index")  }}" class="menu-detail">
                <div class="icon-menu1">
                    <p class="text-menu">Employee </p>
                </div>
            </a>
            <a href="{{ route("salarys.index") }}" class="menu-detail active">
                <div class="icon-menu5">
                    <p class="text-menu">Salary</p>
                </div>
            </a>
        </div>
    </div>
    <div class="listofemployees">
        <div class="box-head">
            <div class="select-yearsalary">
                <div class="select-year">
                    <select>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                    </select>
                </div>
                <div class="add-headsalary">
                    <a href="#popup2" class="btn-newsalary">
                        <img class="icon-addsalary" src="../images/icon-salary/addsalary.png">
                        <p class="add-newsalary">New Salary</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="box-headtablesalary">
            <div class="title-employeesalary">Employee Salary</div>
        </div>
        <div class="box-table">
            <table class="table-salary">
                <tr class="topic-employee">
                    <th class="list-monthsalaryfirst">Month</th>
                    <th class="list-monthsalary">Salary</th>
                    <th class="list-monthsalary">Increase</th>
                    <th class="list-monthsalary">Reduce</th>
                    <th class="list-monthsalarynetpaid">Net paid</th>
                </tr>


                @foreach($folder_salaries as $folder_salary)
                    <tr class="topic-salaryadd">
                        <td class="list-detailsalary">
                            <div class="icon-namemonth">
                                <a href="/salaryList/{{$folder_salary->id}}">
                                    <img class="icon-folder" src="../images/icon-salary/foldersalary.svg">
                                </a>
                                <div class="month-folder">
                                    {{$folder_salary->month}}
                                    <p align="center">
                                        {{$folder_salary->year}}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="list-detailsalary">
                            {{$folder_salary->sum_salary}}
                        </td>
                        <td class="list-detailsalary"></td>
                        <td class="list-detailsalary">
                            ({{$folder_salary->sum_reduce}})
                        </td>
                        <td class="list-detailnetpaid">
                            ({{$folder_salary->sum_salary-$folder_salary->sum_reduce}})
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div class="box-salarylast"></div>
    </div>
</div>
<form action="{{ route('salarys.store') }}" method="POST">
    @csrf
    <div id="popup2" class="overlay-newsalary">
        <div class="popup-newsalary">
            <a class="close" href="#">&times;</a>
            <div class="title-newsalary">
                New Salary
            </div>
            <p class="list-newfoldersalary">
                Please select Month and Year to create folder
            </p>
            <div class="select-monthyear">
                <div class="select-monthnewsalary">
                    <p class="month-newsalary">Month : </p>
                    <select class="new-salary" name="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="select-yearnewsalary">
                    <p class="year-newsalary">Year :</p>
                    <select class="newyear-salary" name="year">
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
            </div>
            <button class="btn-submitnewsalary" onclick="myFunction()">
                Submit
            </button>
        </div>
    </div>
</form>


</body>

</html>
