<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <link href="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <title>Document</title>
</head>

<body>

  <?php
  error_reporting(E_ALL ^ E_NOTICE);
  include  '../vendor/autoload.php';
  $mon = new MongoDB\Client();
  $conn = $mon->iparuba->statustotals;
  $ip_status = $conn->find()->toArray();


  // for ($o = 0; $o < count($ip_status); $o++) {
  //   if ($ip_status[$o]['Status'] === "Offline") {
  //     echo  $ip_status[$o]['Max'];
  //   }
  // }


  ?>
  <div class="container">

    <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
      <div class="table-responsive fs-3">
        <table class="table table-striped gy-7 gs-7" id="test">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
              <!-- <th class="min-w-200px fs-3">#</th> -->
             
              <th class="min-w-200px fs-3">Max IP</th>
              <th class="min-w-200px fs-3">Ap name</th>
              <th class="min-w-200px fs-3">Status</th>
              <th class="min-w-200px fs-3">Last day</th>
              <th class="min-w-200px fs-3">Time</th>


            </tr>
          </thead>
          <tbody>
            <?php

            for ($i = 0; $i < count($ip_status); $i++) {
              
              if ($ip_status[$i]['Status'] === "Offline") {
            ?>
                <tr class=" fs-5">
                
                  <td><?php echo $ip_status[$i]['Max']; ?></td>
                  <td><?php echo $ip_status[$i]['Apname']; ?> </td>
                  <td style="color:#E10808;"><?php echo $ip_status[$i]['Status']; ?> </td>
                  <td><?php echo $ip_status[$i]['d/m/y']; ?> </td>
                  <td><?php echo $ip_status[$i]['time']; ?> </td>
                </tr>
            <?php
              }
            } ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.table').DataTable();
    });
  </script>
</body>

</html>