<?php
class CsvImporter {

    private $fp;
    private $header;
    private $delimiter;
    private $length;

    //--------------------------------------------------------------------
    function __construct($file_name, $delimiter = "\t", $length = 8000){
        $this->fp = fopen($file_name, "r");
        $this->delimiter = $delimiter;
        $this->length = $length;

        $this->header = fgetcsv($this->fp, $this->length, $this->delimiter);
        
    }

    //--------------------------------------------------------------------
    function __destruct(){
        if ( $this->fp ) {
            fclose($this->fp);
        }
    }

    //--------------------------------------------------------------------
    // get the array of csv data
    function get($max_lines = 0){
        //if $max_lines is set to 0, then get all the data
        $data = array();

        if ( $max_lines > 0 )
            $line_count = 0;
        else
            $line_count = -1; // so loop limit is ignored

        while ( $line_count < $max_lines && ($row = fgetcsv($this->fp, $this->length, $this->delimiter)) !== FALSE ) {
            foreach ( $this->header as $i => $heading_i ) {
                $row_new[$heading_i] = $row[$i];
            }
            // $data[] = $row_new;            
            $data[] = $this->make_indexed_array($row_new);            

            if ( $max_lines > 0 ) 
                $line_count++;
        }

        return $data;
    }

    //--------------------------------------------------------------------
    // make indexed array
    function make_indexed_array($data){
        foreach ( $data as $key => $value ) {
            $header_array = explode(',', $key);
            $data_array = explode(',', $value);
        }      

        return array_combine($header_array, $data_array);
    }

    // -------------------------------------------------------------------------
    // combine two arrays into a single array
    // if contractName match combine two array else leave empty 
    function combine_array($contract_array, $awarded_array){
        $final_array = array();

        $empty_array = array(
            'contractDate' =>  "",
            'completionDate' =>  "",
            'awardee' =>  "",
            'awardeeLocation' =>  "",
            'Amount' =>  "",
            'latlng' => ""
        );

        foreach ($contract_array as $c_key => $c_value) {
            $common = $this->check_contract_name($awarded_array, $c_value['contractName']);

            if ( $common === false ) {
                $final_array[] = array_merge($contract_array[$c_key], $empty_array);
            }
            else {
                $final_array[] = array_merge($contract_array[$c_key], $awarded_array[$common]);
            }            
        } 
        return $final_array;
    }

    // ------------------------------------------------------------------
    function check_contract_name($awarded_array, $contract_name){
        
        foreach ($awarded_array as $key => $value) {                 
            if ( $value['contractName'] == $contract_name ){
                return $key;
            }
        }
        return false;
    }

    // -------------------------------------------------------------------------------------------
    function array_to_csv_download($array, $filename = "final.csv", $delimiter=",") {

        // header('Content-Type: application/csv');
        // header('Content-Disposition: attachment; filename="'.$filename.'";');

        // $f = fopen('php://output', 'w');
        $f = fopen($_SERVER['DOCUMENT_ROOT'] . "/yipl-test/uploads/final.csv","wb");

        $header_array = array(
            'contractName,status,bidPurchaseDeadline,bidSubmissionDeadline,bidOpeningDate,tenderid,publicationDate,publishedIn,contractDate,completionDate,awardee,awardeeLocation,Amount,latlng'
        );
        foreach ( $header_array as $line ) {
            $val = explode(",", $line);
            fputcsv($f, $val);
        }

        foreach ($array as $line) {
            fputcsv($f, $line, $delimiter);
        }
    }

    // -----------------------------------------------------------------------------------------------
    function sum_closed_amount($array_data){
        $amount = 0;

        foreach( $array_data as $key => $value ) {
            if ( trim($value['status']) == "Closed" )
                $amount += $value['Amount'];
        }

        return $amount;
    }

    // --------------------------------------------------------------------------------------------------
    // get latitude and longitude using google api
    function get_latlng($address){
        $country = "&sensor=false&region=NP";
        $address_detail = $address . $country;

        $url = "http://maps.google.com/maps/api/geocode/json?address=" . $address;
        $response = file_get_contents($url);
        $response = json_decode($response, true);         
         
        $lat = $response['results'][0]['geometry']['location']['lat'];
        $lng = $response['results'][0]['geometry']['location']['lng'];
         
        return $lat . " " . $lng;
    }

    // ------------------------------------------------------------------------------------
    // insert latitude and longitude in the array
    function put_latlng($awarded_data){
        foreach ( $awarded_data as $key => $value ) {
            $city = trim($value['awardeeLocation']);

            $awarded_data[$key]['latlng'] = $this->get_latlng($city);
        }
        return $awarded_data;
    }

}