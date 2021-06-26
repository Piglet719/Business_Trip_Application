<script>
function Hello(name){
    alert('Hello ' + name + '!'); location.href = 'index_employee.html';
}
</script>
<?php
if (!(empty($_POST['username']))){
    include('db_connect.php');

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM dbo.employee WHERE Name='$username'";
    $query = sqlsrv_query($conn,$sql) or die("sql error".sqlsrv_errors());
    $row = sqlsrv_fetch_array($query);
    if($password != $row['Password']){
        echo "<script>alert('Error username or password!'); location.href = 'index.html';</script>";
    }
    else if($username == 'sa'){
        echo "<script>alert('SA mode!'); location.href = 'index_sa.html';</script>";
    }
    else{
        echo "<script> Hello('$username'); </script>";
    }
}
else{
    echo "<script>alert('Username is void!'); location.href = 'index.html';</script>";
}
?>