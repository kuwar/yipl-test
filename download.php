<?php

require_once( "class/CsvImporter.class.php" );

$contract_importer = new CsvImporter("uploads/contracts.csv");
$data_contracts = $contract_importer->get();

$award_importer = new CsvImporter("uploads/awards.csv");
$data_awards = $award_importer->get();
// add latitude and longitude in array
$data_awarded = $award_importer->put_latlng($data_awards);


$combined_data = $award_importer->combine_array($data_contracts, $data_awarded);
// print_r($combined_data);

// exporting to csv file
$award_importer->array_to_csv_download($combined_data);
