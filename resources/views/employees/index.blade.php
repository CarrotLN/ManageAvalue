<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>--}}

    <script src="../js/jquery.js" ></script>
    <title>Employee Management</title>
</head>

<body>
<div class="header">
    <img src="../../images/logo-home.svg" class="logo">
    <div class="employee-management">Employee Management</div>
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
                    <p class="text-menu">Statistics</p>
                </div>
            </a>
            <a href="{{ route("employees.index")  }}" class="menu-detail active">
                <div class="icon-menu4">
                    <p class="text-menu">Employee </p>
                </div>
            </a>
            <a href="{{ route("salarys.index") }}" class="menu-detail">
                <div class="icon-menu2">
                    <p class="text-menu">Salary</p>
                </div>
            </a>
        </div>
    </div>
    <div class="listofemployees">
        <div class="box-head">
            <div class="add-head">
                <form action="{{ route('employees.index') }}" method="get">
                    {{ csrf_field() }}
                    <div class="search-add">
                        <input class="search" type="text" placeholder="Search" name="search"
                               value="{{ old('search') }}">
                        <img class="icon-search" src="../../images/employee/search.svg">
                    </div>
                </form>
                <div class="btn-addemployee">
                    <a href="{{ route('employees.create') }}" class="btn-head">
                        <img class="icon-add" src="../../images/employee/add-employee.svg">
                        <p class="add">Add Employee</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="box-headtable">
            <div class="title-list">List of employees</div>
        </div>
        <div class="box-table">
            <table class="table-employee">
                <tr class="topic-employee">
                    <th class="list-employee">
                        <p class="list-namesurname">
                            Name - surname
                        </p>
                    </th>
                    <th class="list-employee">Position</th>
                    <th class="list-employee">Salary(฿)</th>
                </tr>
                @foreach($employees as $employee)
                    <tr class="topic-employee">
                        <td class="list-detail">
                            <div class="icon-name">

                                <div class="name-lastname">
                                    {{ $employee->name }} {{ $employee->surname }}
                                </div>
                            </div>
                        </td>
                        <td class="list-detail">{{ $employee->position }}</td>
                        <td class="list-detail">$ {{ $employee->salary }}</td>
                        <td class="click">
                            <a href="{{ route('employees.edit',$employee->id)}}">
                                <img class="icon-repair" src="../../images/employee/edit.svg"/>
                            </a>
                            <a href="#popup{{ $employee->id }}">
                                <img class="icon-delete" src="../../images/employee/delete.svg">
                            </a>
                        </td>
                    </tr>
                    <div id="popup{{ $employee->id }}" class="overlay">
                        <div class="popup">
                            <a class="close" href="#">&times;</a>
                            <div class="icondeletepopup"><img class="icon-deletepopup"
                                                              src="../images/employee/confirm-delete.png"></div>
                            <div class="title-delete">Delete Confirmation</div>
                            <div class="content-delete">
                                You are about to delete a record, Are You Sure ?
                            </div>
                            <button class="btn-cancel"><a href="#" class="cancel">Cancel</a></button>
                            <button class="btn-delete"><a href="#" class="delete" onclick="myFunction({{ $employee->id }})">Delete</a></button>
                        </div>
                    </div>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div id="snackbar">
    <img class="icon-alert" src="../images/alert.svg">
    <p class="deleted-completed"> Delete Successfull </p>
    <a class="close" href="#">&times;</a>
</div>
<script>
    function myFunction(id) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '/employee/delete',
            data: {"_token": "{{ csrf_token() }}", 'id': id},
            success: function (data) {
                console.log(data.message);
            }

        });
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
            location.reload();
        }, 3000);

    }

</script>


</body>

</html>
