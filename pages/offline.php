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

  $mon = new MongoDB\Client();
  $conn = $mon->iparuba->offline;
  $data_offline = $conn->find()->toArray();

  $conn = new MongoDB\Client();
  $companydb  = $conn->iparuba;
  $delere = $companydb->offline;
   
  function dateDiv($t1, $t2)
  { // ส่งวันที่ที่ต้องการเปรียบเทียบ ในรูปแบบ มาตรฐาน 2006-03-27 21:39:12

    $t1Arr = splitTime($t1);
    $t2Arr = splitTime($t2);

    $Time1 = mktime($t1Arr["h"], $t1Arr["m"], $t1Arr["s"], $t1Arr["M"], $t1Arr["D"], $t1Arr["Y"]);
    $Time2 = mktime($t2Arr["h"], $t2Arr["m"], $t2Arr["s"], $t2Arr["M"], $t2Arr["D"], $t2Arr["Y"]);
    $TimeDiv = abs($Time2 - $Time1);

    $Time["D"] = intval($TimeDiv / 86400); // จำนวนวัน
    $Time["H"] = intval(($TimeDiv % 86400) / 3600); // จำนวน ชั่วโมง
    $Time["M"] = intval((($TimeDiv % 86400) % 3600) / 60); // จำนวน นาที
    $Time["S"] = intval(((($TimeDiv % 86400) % 3600) % 60)); // จำนวน วินาที
    return $Time;
  }



  function splitTime($time)
  { // เวลาในรูปแบบ มาตรฐาน 2006-03-27 21:39:12 
    $timeArr["Y"] = substr($time, 2, 2);
    $timeArr["M"] = substr($time, 5, 2);
    $timeArr["D"] = substr($time, 8, 2);
    $timeArr["h"] = substr($time, 11, 2);
    $timeArr["m"] = substr($time, 14, 2);
    $timeArr["s"] = substr($time, 17, 2);
    return $timeArr;
  }
  
  $oo = -1;
  for ($i = 0; $i  < count($ip_status); $i++) {
    if ($ip_status[$i]["Status"] === "Online") {
       $delereResult = $delere->deleteMany(
        ['Max' => $ip_status[$i]["Max"]]
      );
    }
    if ($ip_status[$i]["Status"] === "Offline") {
      $ip_offline_arr[] =  $ip_status[$i]['Max'];
      for ($f = 0; $f < count($data_offline); $f++) {
        if ($ip_status[$i]['Max'] === $data_offline[$f]['Max']) {
          $oo = $oo + 1;
          $o = $o + 1;
          $time_arr[] =  [
            'Mac' => $data_offline[$f]['Max'],
            'Tmie'  => $data_offline[$f]['Time']


          ];
        }
      }
     
    }
    
    }
  
  echo "<pre>";
  print_r($time_arr );
  echo "</pre>";
  $int =  $num[0];
  

  if ($ip_offline_arr != null) {
  for ($go = 0; $go < count($ip_offline_arr); $go++) {


    $t1 = $data[$go][0][0];
    $t2 = $data[$go][$int - 1][$int - 1];
    $time = dateDiv($t1, $t2);
  }

  }


  ?>
  <div class="container">

    <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
      <div class="table-responsive fs-3">
        <table class="table table-striped gy-7 gs-7" id="test">
          <thead>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
              <!-- <th class="min-w-200px fs-3">#</th> -->
              <th class="min-w-100px fs-3">Mac IP</th>
              <th class="min-w-100px fs-3">IP</th>
              <th class="min-w-100px fs-3">Ap name</th>
              <th class="min-w-100px fs-3">Status</th>
              <th class="min-w-100px fs-3">Last day</th>
              <th class="min-w-100px fs-3">Time</th>
              <th class="min-w-100px fs-3">Time Offline</th>


            </tr>
          </thead>
          <tbody>
            <?php

            for ($i = 0; $i < count($ip_status); $i++) {

              if ($ip_status[$i]['Status'] === "Offline") {
            ?>
                <tr class=" fs-5">

                  <td><?php echo $ip_status[$i]['Max']; ?></td>
                  <td><?php echo $ip_status[$i]['ip']; ?></td>
                  <td><?php echo $ip_status[$i]['Apname']; ?> </td>
                  <td style="color:#E10808;"><?php echo $ip_status[$i]['Status']; ?> </td>
                  <td><?php echo date("d/m/Y ", strtotime($ip_status[$i]["d/m/y"])) ?> </td>
                  <td><?php echo $ip_status[$i]['time']; ?> </td>
                  <td><?php echo $time['D'] . " วัน " . $time['H'] . " ชั่วโมง " . $time['M'] . " นาที " ?></td>
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