
<div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
<?php
   // $url = "http://127.0.0.1:8000/api/";
    // $ip = '172.16.0.50';$sid = 'tL7NZFoTY5HX4a4phhMw';
    // $url = "https://".$ip.":4343/rest/show-cmd?iap_ip_addr=".$ip."&cmd=show%20clients&sid=".$sid;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "Content-Type: application/json",
    );
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    //echo $resp;
    $ex = explode('/', $resp);
    //echo count($ex);
    //echo"<pre>";
    //echo"</pre>";
    $data = array_chunk($ex, 12);
    //echo count($data);
    // echo"<pre>";
    // print_r($data);
    // echo"</pre>";

   
    ?>
<div class="table-responsive">
	<table class="table table-striped gy-7 gs-7">
		<thead>
			<tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
				<th class="min-w-200px">Name</th>
				<th class="min-w-200px">IP Address</th>
				<th class="min-w-200px">MAC Address</th>
				<th class="min-w-200px">OS</th>
				<th class="min-w-300px">ESSID</th>
				<th class="min-w-200px">Access Point</th>
				<th class="min-w-200px">Channel </th>
				<th class="min-w-200px">Type </th>
				<th class="min-w-200px">Role </th>
				<th class="min-w-200px">IPv6 Address </th>
				<th class="min-w-200px">Signal </th>
				<th class="min-w-200px">IPv6 Address </th>

			</tr>
		</thead>
		<tbody>
		<?php for ($i = 0; $i < count($data) - 1; $i++) {
            ?>
            <tr>    
            <?php for ($y = 0; $y < 12; $y++) {
            $arr = $data[$i][$y];
             ?> <td><?php print_r($arr) ?></td>
         <?php } ?>
            </tr>
            <?php } ?>
		</tbody>
	</table>
</div>
</div>