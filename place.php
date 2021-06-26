<?php
header("Content-Type:text/html; charset=utf-8");
include"db_connect.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Business Trip Application Form</title>
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
        <section class="bg-insert">
            <div id="contents">
                <form name="form" action="place.php" method="POST" accept-charset="UTF-8" align="center">
                    <div class="detail_box clearfix">
                        <div class="link_box">
                            <h3>新增出差地點</h3>
                            <div class="input-group mb-3 myinput1">
                                <label class="col-form-label">出差地點&nbsp</label>
                                <input type="text" class="form-control" name="tripplace">
                            </div>
                            <div class="input-group mb-3 myinput1">
                            <select class="form-select" aria-label="Default select example" name="category">
                                    <option selected>出差類型&nbsp</option>
                                    <option value="國內">國內</option>
                                    <option value="國外">國外</option>
                            </select>
                            </div>
                            <div class="input-group mb-3 myinput1">
                                <label class="col-form-label">住宿需求&nbsp</label>
                                <input type="text" class="form-control" name="accommodationneeds">
                            </div>
                            <div class="input-group mb-3 myinput1">
                                <label class="col-form-label">住宿說明&nbsp</label>
                                <input type="text" class="form-control" name="accommodationdescription">
                            </div>
                            <div class="input-group mb-3 myinput1">
                                <label class="col-form-label">行程說明&nbsp</label>
                                <input type="text" class="form-control" name="itinerarydescription">
                            </div>
                            <br>
                            <button type="reset" class="btn btn-primary">Clear</button>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </br>
                        </div>
                    </div>
                </form>
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
    if(!(empty($_POST['tripplace'])) && !(empty($_POST['itinerarydescription']))){
        $tripplace=$_POST['tripplace'];
        $category=$_POST['category'];
        $itinerarydescription=$_POST['itinerarydescription'];
        $accommodationneeds=$_POST['accommodationneeds'];
        $accommodationdescription=$_POST['accommodationdescription'];
    
        $sql="INSERT INTO dbo.place VALUES('$tripplace','$itinerarydescription','$category','$accommodationneeds','$accommodationdescription')";
    	
        if(!sqlsrv_query($conn,$sql)){
            echo "<script>alert('Error input!'); location.href = 'place.php';</script>";
        }
        else{
            echo "<script>alert('Insert successfully!'); location.href = 'place.php';</script>";
        }
    }
    else{
        echo "<script>alert('Please fill all tables!'); location.href = 'place.php';</script>";
    }
}
?>