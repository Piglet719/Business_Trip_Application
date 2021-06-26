<?php
header("Content-Type:text/html; charset=utf-8");
include"db_connect.php";
$sql="SELECT Category, COUNT(Category) AS Amounts FROM dbo.place JOIN dbo.apply ON dbo.apply.TripPlace=dbo.place.TripPlace AND dbo.apply.ItineraryDescription=dbo.place.ItineraryDescription GROUP BY Category";
$sql1="SELECT Sector, COUNT(Sector) AS Sectors FROM dbo.employee JOIN dbo.apply ON dbo.apply.Applicant=dbo.employee.name GROUP BY Sector";
$query=sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
$query1=sqlsrv_query($conn,$sql1) or die("sql error".sqlsrv_errors());
$json=[];
$json2=[];
$json3=[];
$json4=[];
while($row=sqlsrv_fetch_array($query)){
    $json[] = $row['Category'];
    $json2[] = $row['Amounts'];
}
while($row=sqlsrv_fetch_array($query1)){
    $json3[] = $row['Sector'];
    $json4[] = $row['Sectors'];
}
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
        <section class="bg-graph">
            <div id="contents">
                <form align="center">
                    <div class="detail_box clearfix">
                        <div class="link_box">
                            <h3>出差員工統計</h3>
                            <canvas id="myChart1"></canvas>
                            <script>
                            var ctx = document.getElementById("myChart1").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo json_encode($json3);?>,
                                    datasets: [{ 
                                        data: <?php echo json_encode($json4);?>,
                                        backgroundColor: [
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                    }]
                                },
                                options: {
                                    legend: {
                                        labels: {
                                            fontColor: 'black',
                                            fontSize: 16
                                        }
                                    }
                                }
                            });
                            </script>
                            <canvas id="myChart"></canvas>
                            <script>
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: <?php echo json_encode($json);?>,
                                    datasets: [{ 
                                        data: <?php echo json_encode($json2);?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)'
                                        ],
                                    }]
                                },
                                options: {
                                    legend: {
                                        labels: {
                                            fontColor: 'black',
                                            fontSize: 16
                                        }
                                    }
                                }
                            });
                            </script>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2021 - Piglet</div></div>
        </footer>
    </body>
</html>
