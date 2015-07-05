<?php

require_once( "class/CsvImporter.class.php" );

$contract_importer = new CsvImporter("uploads/contracts.csv");
$data_contracts = $contract_importer->get();


$award_importer = new CsvImporter("uploads/awards.csv");
$data_awards = $award_importer->get();
// add latitude and longitude in array
$data_awarded = $award_importer->put_latlng($data_awards);


$combined_data = $award_importer->combine_array($data_contracts, $data_awarded);
// echo "<pre>";
// print_r($combined_data);

// exporting to csv file
$award_importer->array_to_csv_download($combined_data);
die;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Leaflet Map</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="assets/style/style.css">	

</head>
<body>

<div class="row">
	<div class="page-header">
		<h1>Total Amount of closed contracts: <strong><?php echo $award_importer->sum_closed_amount($combined_data); ?></strong></h1>
	</div>
</div>

</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</html>