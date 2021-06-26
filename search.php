<?php
header("Content-Type:text/html; charset=utf-8");
include"db_connect.php";
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>出差查詢結果</title>
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
                <a class="navbar-brand" href="index_employee.html">Business Trip</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbaarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">出差申請</a>
                            <section class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="search.html">出差查詢</a>
                                <a class="dropdown-item" href="insert.php">出差申請</a>
                            </section>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="notice_employee.html">出差注意事項</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.html">登出</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="bg-search">
            <div id="contents">
                <div class="detail_box clearfix">
                    <div class="link_box">
                        <h3>查詢出差結果</h3>
                    </div>
                    <?php
                        if(empty($_POST['applicant'])){
                            echo "Please input your name!<br/>";
                        }
                        else{
                            $applicant=$_POST['applicant'];
                            $sql="SELECT employeeApp.Sector AS AppSector,employeeAg.Sector AS AgSector,Applicant,Agent,Cause,Category,apply.TripPlace,Days,Traffic,BookingDescription,
                            AccommodationNeeds,AccommodationDescription,Currency,Price,apply.ItineraryDescription,Remarks,
                            CONVERT(varchar, StartDate, 120) as StartDate, CONVERT(varchar, EndDate, 120) as EndDate, CONVERT(varchar, InsertTime, 120) as InsertTime
                            FROM dbo.apply JOIN dbo.place ON apply.TripPlace=place.TripPlace AND apply.ItineraryDescription=place.ItineraryDescription
                            JOIN dbo.employee AS employeeApp ON Applicant=employeeApp.Name
                            JOIN dbo.employee AS employeeAg ON Agent=employeeAg.Name
                            WHERE Applicant='$applicant'";
                            $query=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
                            while($row=sqlsrv_fetch_array($query)){ ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td style="width: 200px;">申請時間</td>
                                    <td><?php echo $row['InsertTime'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">申請人</td>
                                    <td><?php echo $row['Applicant'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">申請部門</td>
                                    <td><?php echo $row['AppSector'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">代理人</td>
                                    <td><?php echo $row['Agent'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">代理部門</td>
                                    <td><?php echo $row['AgSector'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">事由</td>
                                    <td><?php echo $row['Cause'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">出差類型</td>
                                    <td><?php echo $row['Category'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">出差地點</td>
                                    <td><?php echo $row['TripPlace'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">預計天數</td>
                                    <td><?php echo $row['Days'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">預計開始日</td>
                                    <td><?php echo $row['StartDate'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">預計結束日</td>
                                    <td><?php echo $row['EndDate'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">交通需求</td>
                                    <td><?php echo $row['Traffic'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">訂票說明</td>
                                    <td><?php echo $row['BookingDescription'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">住宿需求</td>
                                    <td><?php echo $row['AccommodationNeeds'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">住宿說明</td>
                                    <td><?php echo $row['AccommodationDescription'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">預支幣別</td>
                                    <td><?php echo $row['Currency'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">預支費用</td>
                                    <td><?php echo $row['Price'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">行程說明</td>
                                    <td><?php echo $row['ItineraryDescription'];?></td>
                                </tr>
                                <tr>
                                    <td style="width: 200px;">備註</td>
                                    <td><?php echo $row['Remarks'];?></td>
                                </tr>
                            </table>
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