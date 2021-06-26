<?php
header("Content-Type:text/html; charset=utf-8");
include"db_connect.php";
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>出差資料維護</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css"/>
        <link rel="stylesheet" href='css/bootstrap.min.css'>
        <link rel="stylesheet" href="css/styles.css"/> 
        <link rel="stylesheet" href="css/mystyle.css">
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 navbar-shrink" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index_sa.html">Business Trip</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbaarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">出差申請</a>
                            <section class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="search_sa.html">出差查詢</a>
                                <a class="dropdown-item" href="insert_sa.php">出差申請</a>
                                <a class="dropdown-item" href="update.html">出差維護</a>
                            </section>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="notice_sa.html">出差注意事項</a></li>
                        <li class="nav-item"><a class="nav-link" href="graph.php">出差員工統計表</a></li>
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbaarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">新增資料</a>
                            <section class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="employee.php">新增員工</a>
                                <a class="dropdown-item" href="place.php">新增出差地點</a>
                            </section>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="index.html">登出</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="bg-update">
            <div id="contents">
                <div class="detail_box clearfix">
                    <div class="link_box">
                        <h3>修改出差資料</h3>
                    </div>
                    <?php
                        if(empty($_POST['applicant']) || empty($_POST['startdate'])){
                            echo "Please input your name and start date!<br/>";
                        }
                        else{
                            $applicant=$_POST['applicant'];
                            $startdate=$_POST['startdate'];
                            $sql="SELECT Applicant,Agent,Cause,TripPlace,Days,Traffic,BookingDescription,
                            Currency,Price,ItineraryDescription,Remarks,
                            CONVERT(varchar, StartDate, 120) as StartDate, CONVERT(varchar, EndDate, 120) as EndDate, CONVERT(varchar, InsertTime, 120) as InsertTime
                            FROM dbo.apply WHERE Applicant='$applicant' AND StartDate='$startdate'";
                            $query=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());;
                            $row=sqlsrv_fetch_array($query);
                            if(empty($row['Applicant'])){
                                echo "Application doesn't exist!<br/>";
                            }
                            else{ ?>
                            <form name="form" action="update.php" method="POST" accept-charset="UTF-8" align="center">
                                <div class="link_box">
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">申請時間</label>
                                        <input id="inserttime" type="text" class="form-control" name="inserttime" value="<?php echo $row['InsertTime'];?>" readonly>
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">申請人&nbsp</label>
                                        <input id="applicant" type="text" class="form-control" name="applicant" value="<?php echo $applicant;?>" readonly>
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">代理人&nbsp</label>
                                        <input id="agent" type="text" class="form-control" name="agent" value="<?php echo $row['Agent'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">事由&nbsp</label>
                                        <input id="cause" type="text" class="form-control" name="cause" value="<?php echo $row['Cause'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">出差地點&nbsp</label>
                                        <input id="place" type="text" class="form-control" name="tripplace" value="<?php echo $row['TripPlace'];?>" readonly>
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">預計天數&nbsp</label>
                                        <input id="days" type="text" class="form-control" name="days" value="<?php echo $row['Days'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">預計開始日&nbsp</label>
                                        <input id="startdate" type="text" class="form-control" name="startdate" value="<?php echo $row['StartDate'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">預計結束日&nbsp</label>
                                        <input id="enddate" type="text" class="form-control" name="enddate" value="<?php echo $row['EndDate'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">交通需求&nbsp</label>
                                        <input id="traffic" type="text" class="form-control" name="traffic" value="<?php echo $row['Traffic'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">訂票說明&nbsp</label>
                                        <input id="bookingdescription" type="text" class="form-control" name="bookingdescription" value="<?php echo $row['BookingDescription'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">預支幣別&nbsp</label>
                                        <input id="currency" type="text" class="form-control" name="currency" value="<?php echo $row['Currency'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">預支費用&nbsp</label>
                                        <input id="price" type="text" class="form-control" name="price" value="<?php echo $row['Price'];?>">
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">行程說明&nbsp</label>
                                        <input id="itinerarydescription" type="text" class="form-control" name="itinerarydescription" value="<?php echo $row['ItineraryDescription'];?>" readonly>
                                    </div>
                                    <div class="input-group mb-3 myinput1">
                                        <label class="col-form-label">備註&nbsp</label>
                                        <input id="remarks" type="text" class="form-control" name="remarks" value="<?php echo $row['Remarks'];?>">
                                    </div>
                                    <button type="reset" class="btn btn-primary">Clear</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </br>
                                </div>
                            </form>

                        <?php 
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2021 - Piglet</div></div>
        </footer>
        <!--gotop-->
        <div id="gotop"><a href="#"></a></div>
        <script>
        $(function(){
            $('#gotop').click(function(){ 
                $('html,body').animate({scrollTop:0}, 1000);
            });
            $(window).scroll(function() {
                if ( $(this).scrollTop() > 300 ){
                    $('#gotop').fadeIn(100);
                } else {
                    $('#gotop').stop().fadeOut(100);
                }
            }).scroll();
        });
        </script>
    </body>
</html>

<?php
if(isset($_POST['submit'])){
    $applicant=$_POST['applicant'];
    $agent=$_POST['agent'];
    $cause=$_POST['cause'];
    $days=$_POST['days'];
    $days=(int)$days;
    $traffic=$_POST['traffic'];
    $bookingdescription=$_POST['bookingdescription'];
    $currency=$_POST['currency'];
    $price=$_POST['price'];
    $price=(int)$price;
    $remarks=$_POST['remarks'];
    $startdate=$_POST['startdate'];
    $enddate=$_POST['enddate'];
    $inserttime=$_POST['inserttime'];

    $sql="UPDATE dbo.apply SET
    Applicant='$applicant',
    Agent='$agent',
    Cause='$cause',
    Days='$days',
    StartDate='$startdate',
    EndDate='$enddate',
    Traffic='$traffic',
    Currency='$currency',
    Price='$price',
    Remarks='$remarks',
    InsertTime='$inserttime'
    WHERE Applicant = '$applicant'";
    $query=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());;
    if(sqlsrv_rows_affected($query)){
        echo "<script>alert('Data have already updated!'); location.href = 'index_sa.html';</script>";
    }
    else{
        echo "<script>alert('Error input!'); location.href = 'index_sa.html';</script>";
    }
}
?>