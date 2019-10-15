<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Edit Employee</title>
</head>

<body>

<form action="{{ route('employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="header-banner">
        <a href="{{ route("employees.index") }}">
            <img src="../../images/close-line.svg" class="out">
        </a>
        <div class="add-employee">Edit Employee</div>
        <button class="submit" type="submit">Submit</button>
    </div>
    <div class="section-addemployee">
        <div class="detail-employee">
            <div class="detail-input-employee">
                <p class="topic-employee">Personal Information </p>
                <div class="input-name">
                    <label>Name : </label>
                    <input class="section-input-employee" type="text" name="name" value="{{ $employee->name }}"
                           required>
                </div>
                <div class="input-surname">
                    <label>Surname :</label>
                    <input class="section-input-employee" type="text" name="surname" value="{{ $employee->surname }}"
                           required>
                </div>
                <div class="input-idcard">
                    <label>ID Card :</label>
                    <input class="section-input-employee" type="text" name="id_card" mask="0 0000 00000 00 0"
                           maxlength="17" minlength="13" value="{{ $employee->id_card }}" required>
                </div>
                <div class="input-birthday">
                    <label>Birthday :
                        <div class="bd-employee">
                            <select class="employee-day" name="d" value="{{ $employee->d }}" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <select class="employee-day" name="m" value="{{ $employee->m }}" required>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">Jule</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select class="employee-day" name="y" value="{{ $employee->y }}" required>
                                <option value="1980">1980</option>
                                <option value="1981">1981</option>
                                <option value="1982">1982</option>
                                <option value="1983">1983</option>
                                <option value="1984">1984</option>
                                <option value="1985">1985</option>
                                <option value="1986">1986</option>
                                <option value="1987">1987</option>
                                <option value="1988">1988</option>
                                <option value="1989">1989</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                            </select>
                        </div>
                        <div class="line1"></div>
                    </label>
                </div>

                <p class="topic-contact">Contact</p>
                <div class="input-address">
                    <label>Address :</label>
                    <textarea name="address" class="address" required>{{ $employee->address }}</textarea>
                </div>
                <div class="input-tel">
                    <label>Tel :</label>
                    <input class="section-input-employee" type="text" name="tel" maxlength="11"
                           value="{{ $employee->tel }}" required>
                </div>
                <div class="input-email">
                    <label>E - mail :</label>
                    <input class="section-input-employee" type="text" name="email" value="{{ $employee->email }}"
                           required>
                </div>
                <div class="line"></div>
                <p class="topic-employee">Work Info</p>
                <div class="input-psition">
                    <label>Position :</label>
                    <input class="section-input-employee" type="text" name="position" value="{{ $employee->position }}"
                           required>
                </div>
                <!-- <div class="input-salary"> -->
                <table id="dynamicTable">
                    <tr>
                        <th>Salary :</th>
                        <th class="start-salary">Start Date(Salary) :</th>
                    </tr>

                    @foreach($employee->salaryList as $key => $salary)
                        <tr class="salary-row">

                            <td><input type="text" name="salary[{{$key}}][amount]" placeholder="Enter your Salary"
                                       class="section-input-salary" value="{{$salary->salary}}" readonly/></td>
                            <td><input type="date" name="salary[{{$key}}][date]" class="section-bd-employee"
                                       value="{{$salary->salary_date}}" readonly/></td>
                        </tr>
                    @endforeach
                </table>
                <!-- </div> -->
                <button type="button" name="add" id="add" class="add-salary">Add</button>
                <script type="text/javascript">

                    var i = $("#dynamicTable").find('tr.salary-row').length;
                    $("#add").click(function () {
                        $salaryHTML = '<tr class="salary-row">';
                        $salaryHTML += '<td><input type="text" name="salary[' + i + '][amount]" placeholder="Enter your Salary" class="section-input-salary" required/></td>';
                        $salaryHTML += '<td><input type="date" name="salary[' + i + '][date]"  class="section-bd-employee" required/></td>';
                        $salaryHTML += '<td><button type="button" class="del-icon remove-tr"><img src=\'/images/iconmenu/del.png\'></button></td>';
                        $salaryHTML += '</tr>'
                        $("#dynamicTable").append($salaryHTML);
                        i++;
                    });

                    $(document).on('click', '.remove-tr', function () {
                        $(this).parents('tr').remove();
                    });

                </script>
                <div class="line"></div>
                <p class="topic-employee">Payment Information</p>
                <div class="salary-employee">
                    <label>Social Insurance :</label>
                    <input class="section-input-employee" type="text" name="social_insurance_no"
                           value="{{ $employee->social_insurance_no }}" required>
                    <label>Name Bank :

                        <select name="bank_id" id="bank" class="employee-bank" value="{{ $employee->bank_id }}"
                                required>
                            @foreach($banks as $id => $bank)
                                <option
                                    value="{{ $id }}" {{ (isset($employee) && $employee->bank ? $employee->bank->id : old('bank_id')) == $id ? 'selected' : '' }}>{{ $bank }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('bank_id'))
                            <p class="help-block">
                                {{ $errors->first('bank_id') }}
                            </p>
                        @endif
                    </label>
                    <label>Account No. :</label>
                    <input class="section-input-employee" type="text" name="account_no"
                           value="{{ $employee->account_no }}" required>
                    <div class="line"></div>
                    <p class="topic-employee">Employee Status</p>
                    <div class="box-switch">
                        <label class="detail-switch">Active</label>
                        <label class="switch" value="{{ $employee->status }}" required>
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>

</html>
