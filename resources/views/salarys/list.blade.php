<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <title>Salary Management</title>
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
        <a href="/salarys">
            <button class="back-salary">Back</button>
        </a>
        <div class="box-head">
            <div class="add-head">
                    <div class="topic-month">
                       {{$month}} - {{$year}}
                    </div>
            </div>
        </div>

        <div class="box-headtable">
            <div class="title-list">Employee Salary List</div>
        </div>
        <div class="box-table">
            <table class="table-salary">
                <tr class="topic-salary">
                    <th class="list-salary">
                        <p class="list-namesurname">
                            Name - surname
                        </p>
                    </th>
                    <th class="list-salary-1">Salary</th>
                    <th class="list-salary-1">Increase</th>
                    <th class="list-salary-1">Reduce</th>
                    <th class="list-salary-1">Net paid</th>
                    <th class="list-salary-1">Payment Status</th>
                    <th class="list-salary"></th>
                </tr>
                @foreach($salaryList as $datas)
                    <tr class="topic-salary">
                        <td class="list-salary">
                            <p class="name-lastname">
                                {{$datas->employee->name}} {{$datas->employee->surname}}
                            </p>
                        </td>
                        <td class="list-salary">{{$datas->salary}}</td>

                        <td class="list-salary"></td>
                        <td class="list-salary">({{$datas->social_insurance}})</td>
                        <td class="list-salary">{{$datas->total}}</td>
                        <td class="list-salary">
                            <input type="checkbox" data-id="{{ $datas->id }}" name="status"
                                   class="js-switch" {{ $datas->payment_status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="click-1">
                            <a href="/salaryEdit/{{$datas->id}}">
                                <img class="icon-repair" src="../../images/employee/edit.svg"/>
                            </a>
                            <a href="#popup1">
                                <img class="icon-delete" src="../../images/employee/delete.svg">
                            </a>
                            <a href="#">
                                <img class="icon-repair" src="../../images/icon-salary/print.svg"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</div>

<div id="popup1" class="overlay">
    <div class="popup">
        <a class="close" href="#">&times;</a>
        <div class="icondeletepopup"><img class="icon-deletepopup"
                                          src="../../images/employee/confirm-delete.png"></div>
        <div class="title-delete">Delete Confirmation</div>
        <div class="content-delete">
            You are about to delete a record, Are You Sure?
        </div>
        <button class="btn-cancel"><a href="#" class="cancel">Cancel</a></button>
        <button class="btn-delete"><a href="#" onclick="myFunction()" class="delete">Delete</a></button>
    </div>

</div>

<div id="snackbar">
    <img class="icon-alert" src="../../images/alert.svg">
    <p class="deleted-completed"> Deleted Successfull </p>
    <a class="close" href="#">&times;</a>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function () {
            x.className = x.className.replace("show", "");
        }, 4000);
    }
</script>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function (html) {
        let switchery = new Switchery(html,{size: 'small'});
    });
    $(document).ready(function(){
        $('.js-switch').change(function () {

            let status = $(this).prop('checked') === true ? 1 : 0;
            let userId = $(this).data('id');
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/salary_update_status',
                data: {"_token": "{{ csrf_token() }}",'status': status, 'id': userId},
                success: function (data) {
                    console.log(data.message);
                }
            });
        });
    });
</script>
</body>

</html>
