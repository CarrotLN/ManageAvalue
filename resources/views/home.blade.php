<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/piechart/chartjs-master/Chart.js"></script>
    <script src="../js/piechart/chartjs-master/jquery-2.1.4.min.js"></script>
    <title>Statistics</title>
</head>

<body>
<div class="header">
    <img src="../images/logo-home.svg" class="logo">
    <div class="statics">Statistics</div>
    <a href="{{ route('logout') }}" class="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <img src="../images/logout.png" class="logout">
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
            <a href="" class="menu-detail active">
                <div class="icon-menu">
                    <p class="text-menu">Statistics</p>
                </div>
            </a>
            <a href="{{ route("employees.index") }}" class="menu-detail">
                <div class="icon-menu1">
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
    <div class="blog-statistics">
        <div class="topic-statistics">
            <p class="topic-blog-statistics">Summary information</p>
            <div class="custom-select">
                <select>
                    <option value="0">Year</option>
                    <option value="1">2019</option>
                    <option value="1">2018</option>
                    <option value="1">2017</option>
                    <option value="1">2016</option>
                    <option value="1">2015</option>
                    <option value="1">2014</option>
                    <option value="1">2013</option>
                </select>
                <select>
                    <option value="0">Month</option>
                    <option value="1">January</option>
                    <option value="1">February</option>
                    <option value="1">March</option>
                    <option value="1">April</option>
                    <option value="1">May</option>
                    <option value="1">June</option>
                    <option value="1">July</option>
                    <option value="1">August</option>
                    <option value="1">September</option>
                    <option value="1">October</option>
                    <option value="1">November</option>
                    <option value="1">December</option>
                </select>
            </div>
        </div>
        <div class="chart">
            <canvas id="mycanvas" width="256px" height="256px">
                <script>
                    $(document).ready(function(){
                        var ctx = $("#mycanvas").get(0).getContext("2d");

                        var data = [
                            {
                                value:70,
                                color:"#D95436",
                                label:"DECREASE"
                            },
                            {
                                value:20,
                                color:"#DCF2E4",
                                label:"INCREASE"
                            },
                            {
                                value:70,
                                color:"#91D9BF",
                                label:"OVERTIME"
                            },
                            {
                                value:70,
                                color:"#118C8C",
                                label:"BONUS"
                            },
                            {
                                value:70,
                                color:"#2E3140",
                                label:"TOTAL SALARY"
                            }
                        ];
                        var piechart =new Chart(ctx).Pie(data);
                    });
                </script>
            </canvas>
        </div>
    </div>
</div>
</body>

</html>
