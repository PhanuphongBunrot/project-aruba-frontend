<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
	<title>Document</title>

	<style>
    .mychart {
        width: 320px;

    }

    .mychart1 {

        height: 410px;
        width: 700px;
        display: table-cell;
        vertical-align: middle;
    }
</style>
</head>

<body>
	<?php
	include  '../vendor/autoload.php';
    $mon = new MongoDB\Client();
    $conn = $mon->iparuba->statustotals;
    $ip_status = $conn->find()->toArray();
	$on_s = 0;
	$off_s = 0;
	 for ($o = 0 ; $o < count($ip_status); $o++){
		 if($ip_status[$o]['Status'] === "Online"){
			$on_s = $on_s + 1;
		 }else if($ip_status[$o]['Status'] === "Offline"){
			$off_s = $off_s + 1;
		 }
	 }
	 $on = $on_s;
	 $off = $off_s;
	 $_SESSION['on']  = $on_s;
	 $_SESSION['off'] = $off_s;
	?>

		<div class=" shadow p-3 mb-3 bg-body rounded ">
		<center>
			<h2>Status Total </h2>
			<div class="mychart">

			<canvas  id="myChartDoughnut"></canvas>

			</div>
			
		</div>
	</center>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
<script>
	const dataDoughnut = {
		labels: ['Online', 'Offline', ],
		datasets: [{
			label: 'Weekly Sales',
			data: [<?php echo $on ?>, <?php echo $off ?>],
			backgroundColor: [
				'rgba(0, 154, 71, 0.5)',
				'rgba(255, 99, 132, 0.2)',
			],
			borderColor: [
				'rgba(0, 150, 48)',
				'rgba(255, 99, 132, 1)',
			],
			borderWidth: 1
		}]
	};

	// config 
	const configDoughnut = {
		type: 'pie',
		data: dataDoughnut,
		options: {

		}
	};

	// render init block
	const myChartDoughnut = new Chart(
		document.getElementById('myChartDoughnut'),
		configDoughnut
	);
</script>

</html>