<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/jquery.js"></script>
    <title>Salary Management</title>
</head>

<body>

<div class="header">
    <img src="../images/logo-home.svg" class="logo">
    <div class="employee-management">Salary Management</div>
    <a href="../index.html"><img src="../images/logout.png" class="logout"></a>
</div>
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
        <a href="/salaryList/{{$salaryDetail->folderSalary->id}}">
            <button class="back-salary">Back</button>
        </a>
        <div class="blog-statistics">
            <div class="topic-edit-salary">
                <div class="topic-detail-employee">Employee</div>
                <div class="topic-detail-bank">Bank and Account No</div>
                <div class="topic-detail-net">Net paid</div>
            </div>
            <div class="detail-edit-salary">
                <div
                    class="salary-name-lastname"> {{$salaryDetail->employee->name}} {{$salaryDetail->employee->surname}}
                    <h5>{{$salaryDetail->employee->position}}</h5>
                </div>
                <div class="salary-bank">
                    {{$salaryDetail->employee->bank->name}}
                    <h5>{{$salaryDetail->employee->account_no}}</h5>
                </div>
                <div
                    class="salary-my">{{$salaryDetail->folderSalary->month}}  {{$salaryDetail->folderSalary->year}}</div>
                <div id="total" class="salary-total">{{$salaryDetail->salary}}</div>
            </div>
            <div class="option-detail-salary">
                <div class="salary-overtime-1">
                    <div>
                        <h4>Overtime</h4>
                        <div class="topic-overtime">
                            <div class="detail-overtime">Rate :</div>
                            <div class="detail-overtime">Hours :</div>
                            <div class="detail-overtime">Total (OT) :</div>
                        </div>
                        <div class="input-detail-overtime">
                            <form
                                class="input-detail-overtime">
                                <input
                                    class="input-salary-rate"
                                    name="rate"
                                    type="text"
                                    placeholder="0.00"
                                    value="{{$salaryDetail->rate}}"
                                    id="rate"
                                >
                                <input
                                    class="input-salary-rate"
                                    name="rate_time"
                                    type="text"
                                    placeholder="0"
                                    value="{{$salaryDetail->rate_time}}"
                                    id="hours"
                                >
                                <label class="input-salary-rate">
                                    <div
                                        id="total-overtime"
                                        class="input-salary-rate"
                                        name="sum_ot"
                                        readonly
                                    >

                                    </div>
                                </label>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h4>Salary</h4>
                        <h6>Salary :</h6>
                        <label
                            class="input-salary-month">
                            {{$salaryDetail->salary}}
                        </label>
                        <div class="login-checkbox">
                            <label class="checkbox-label">
                                <input type="checkbox" id="myCheck">
                                <span class="checkbox-custom"></span>
                                <div class="input-title-salary">:Social Insurance</div>
                            </label>
                        </div>
                        <label class="input-salary-month">{{$salaryDetail->social_insurance}}</label>
                    </div>
                </div>

                <div class="salary-overtime">
                    <h4>Other</h4>
                    <table id="other">
                        <tr class="other-row">
                            <td>
                                <select name="other[0][type]" class="section-describe type">
                                    <option value="0" selected>Increase</option>
                                    <option value="1">Decrease</option>
                                </select>
                            </td>
                            <td>
                                <input type="text"
                                       name="other[0][detail]"
                                       placeholder="Describe"
                                       class="section-describe detail">
                            </td>
                            <td>
                                <input type="text" name="other[0][amount]" placeholder="0.00"
                                       class="section-describe-1 amount">
                            </td>
                            <td>
                                <button class="del-icon remove-tr">
                                    <img
                                        src="../../resources/images/iconmenu/del.png" alt=""></button>
                            </td>
                        </tr>
                    </table>
                    <button class="add-describe" id="otherAdd">+ Add</button>
                    <div>
                        <textarea name="note" placeholder="note..."></textarea>
                    </div>

                </div>
            </div>
            <div class="button-other">
                <button class="other-cancel"><a href="../salary/edit-salary.html" class="cancel">Cancel</a></button>
                <button class="other-save"><a href="#popup-save" class="delete">Save</a></button>
            </div>
        </div>
    </div>
    <div id="popup-save" class="overlay">
        <div class="popup">
            <a class="close" href="#">&times;</a>
            <div class="icondeletepopup">
                <img class="icon-deletepopup" src="../images/employee/save.svg">
            </div>
            <div class="title-save">
                Succesfull
            </div>
            <div class="content-delete">
                Employee account has been successfully created!
            </div>


            <button class="btn-saveokay">
{{--                <a href="/salaryList/{{$folder_salaries->id}}" class="delete">--}}
                    Okay
                </a>
            </button>

        </div>
    </div>
</div>

<script>
    var salaryEdit = {
        total: {{$salaryDetail->salary}},
        overtime: {
            rate: 0,
            hours: 0,
            total: 0
        },
        salary: {{$salaryDetail->salary}},
        socialInsurance: {{$salaryDetail->social_insurance}},
        isSocialInsurance: false
    }
    $("#rate").keyup(function () {
        salaryEdit.overtime.rate = $("#rate").val()
        calOT()
        calTotal()
    })
    $("#hours").keyup(function () {
        salaryEdit.overtime.hours = $("#hours").val()
        calOT()
        calTotal()
    })

    $(".amount").keyup(function () {
        calTotal()
    })
    $(".type").change(function () {
        calTotal()
    })

    $("#myCheck").click(function () {
        salaryEdit.isSocialInsurance = !salaryEdit.isSocialInsurance
        calTotal()
    })

    function calOT() {
        salaryEdit.overtime.total = salaryEdit.overtime.rate * salaryEdit.overtime.hours
        $("#total-overtime").text(salaryEdit.overtime.total)
    }

    function calTotal() {
        salaryEdit.total = salaryEdit.salary + salaryEdit.overtime.total
        if (salaryEdit.isSocialInsurance) {
            salaryEdit.total = salaryEdit.total - salaryEdit.socialInsurance
        }
        var otherRows = $("tr.other-row");
        for (var otherRowIndex = 0; otherRowIndex < otherRows.length; otherRowIndex++) {
            var otherRow = $(otherRows[otherRowIndex])
            var typeValue = 1;
            if (otherRow.find('.type :selected').val() == 1) {
                typeValue = -1;
            }
            var amount = otherRow.find('.amount').val();
            var otherAmount = typeValue * amount;
            salaryEdit.total += otherAmount;
        }
        $("#total").text(salaryEdit.total)
    }

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


    var i = $("#other").find('tr.other-row').length;
    $("#otherAdd").click(function () {
        $otherHTML = '<tr class="other-row">';
        $otherHTML += '<td>                     ' +
            '<select name="other[' + i + '][type]" class="section-describe type">\n' +
            '<option value="0" selected>Increase</option>\n' +
            '<option value="1">Decrease</option>\n' +
            '</select>' +
            '</td>';
        $otherHTML += '<td><input type="text" name="other[' + i + '][detail]"  placeholder="Describe" class="section-describe detail" /></td>';
        $otherHTML += '<td><input type="text" name="other[' + i + '][amount]"  placeholder="0.00" class="section-describe-1 amount" /></td>';
        $otherHTML += '<td><button type="button" class="del-icon remove-tr"><img src=\'/images/iconmenu/del.png\'></button></td>';
        $otherHTML += '</tr>'
        $("#other").append($otherHTML);
        i++;
        calTotal()
    });

    $(document).on('click', '.remove-tr', function () {
        $(this).parents('tr').remove();
        calTotal()
    });

</script>
</body>

</html>
