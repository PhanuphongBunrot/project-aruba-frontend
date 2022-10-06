<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
 <?php  
    error_reporting(E_ALL ^ E_NOTICE);
    include  '../vendor/autoload.php';
    $mon = new MongoDB\Client();
    $conn = $mon->iparuba->ipaps;
    $ip_status = $conn->find()->toArray(); ?>
<div class="container">
    
        <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
            <form name="form1"  class="container" action="adddb.php" method="POST" >
                <div style="width: 700px; " class="container">
                    <label style="color: red ;">Mac : </label> 
                 
                    <?php   echo ($_GET['mac']) ; 
                        $_SESSION['mac'] = $_GET['mac'];
                       
                    ?>
                    <hr>
                    <?php  
                         $mac[]= $_GET['mac'] ;
                        for ($i = 0; $i < count($ip_status);$i++){
                            $ip_arr[] =$ip_status[$i]['Max'];
                        }

                        $inn = array_intersect($ip_arr,$mac);
                          $k = key($inn);  
                          $_SESSION['ip'] = $ip_status[$k]['ip']; 
                       
                    ?>
                   
                    <label>Ap Name</label>
                    <input type="text" name="apname" class="form-control fs-5 " value="<?php echo $ip_status[$k]['Apname'] ?>">
                    <label>Serial number </label> 
                    <input type="text" name="sn" class="form-control " value="<?php echo $ip_status[$k]['S/N'] ?>">
                    <br>
                    <button type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการบันทึกข้อมูลหรือไม่')">SAVE</button>
                    <a  href="?page=3" class="btn btn-danger">back</a>
                    

</form>
        </div>
        
        
    
    </div>
</body>

</html>