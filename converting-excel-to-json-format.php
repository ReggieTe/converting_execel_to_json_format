<?php
//Convert the Excel Sheet to CVS Format and save file as a textfile 
//with name **datasource.txt**
//Make Sure DataSource is a textfile format
//How to use the class check at the bottom of the class
//Feel free to share 
//complie by Reggie@247mediahouz.com
//http://www.247mediahouz.com

class ParseClass {

    private $method = "json";
    private $finalDataArray = array();
    //In the given example data is separated by spaces
    private $dataSeparator=" ";

    public function __construct($dataSource = "datasource.txt") {
        $dataArray = array();
        $fileContentsAsArray = $this->removeWithEmptySpace($this->textFileRead($dataSource));

        foreach ($fileContentsAsArray as $singleEntry) {

            $newSingleEntryConvertedIntoArray = $this->removeWithEmptySpace($this->convertStringToArray($singleEntry,$this->dataSeparator));

            array_push($dataArray, $newSingleEntryConvertedIntoArray);
        }
        $this->finalDataArray = $dataArray;
    }

    public function setMethod($method = "printout") {
        $this->method = $method;
    }

    public function Outputting() {

        if (strcasecmp($this->method, "json") == 0) {
            echo 'Outputting data as in json format';
            return json_encode($this->finalDataArray);
        } else {
            echo 'Outputting as a print out<br>';
            echo"<pre>";
            print_r($this->finalDataArray);
            echo '</pre>';
        }
    }

    private function removeWithEmptySpace($uncleanedArray = array()) {
        $cleanedArray = array();
        foreach ($uncleanedArray as $value) {
            if (str_word_count($value) != 0) {
                array_push($cleanedArray, trim($value));
            }
        }
        return $cleanedArray;
    }

    private function convertStringToArray($string, $delimiter = ",") {
        return !empty($string) ? explode($delimiter, $string) : array('0', '1');
    }

    private function textFileCreate($filename = "datasource.txt", $permission = "a") {
        $fileObject = fopen($filename, $permission);
         $content = '1	Jackqueline	Mguni	 MGU 7844 P 	NIC 002	A	19-04-2015	31-04-2015	95877.02	12%	4	46020.97	57	12	2736	144633.99	48	" 3,013.21 "	6	" 18,079.25 "	850	5%	 903.96 	 12 	" 5,753 "	10%	" 1,807.92 "	 57.00 	 -   	" 8,764.74 "	5%	" 1,355.94 "	 9 	9634.76	" -2,225.96 "	86242.26	" 135,869.25 "	20%	" 27,173.85 "	" 108,695.40 "																																																																																																											
																																																																																																																																																		
2	Gerhard	Tobejane	 THO 1907 P 	JOU 001	C	15-05-2015	Weekly	]	12%	3	#VALUE!	57	12	2052	#VALUE!	36	#VALUE!	6	#VALUE!	850	5%	#VALUE!	 12 	#VALUE!	10%	#VALUE!	 57.00 	 -   	#VALUE!	5%	#VALUE!	 1 	5488.77	#VALUE!	#VALUE!	#VALUE!	20%	#VALUE!																																																																																																												
																																																																																																																																																		
3	Regina 	Nicholas	 NIC 5807 P 	JOU 001	A	15-05-2015	15-06-2015	129598.27	12%	6	93310.75	57	12	4104	227013.02	72	" 3,152.96 "	16	" 50,447.34 "	850	5%	" 2,522.37 "	 12 	" 20,736 "	10%	" 5,044.73 "	 57.00 	 -   	" 21,294.51 "	5%	 472.94 	 3 	21186.74	 -365.17 	108411.53	" 205,718.51 "	20%	" 41,143.70 "				2550											2250									3160										3160									3160								3160																																																									
																																																																																																																																																		
4	Luazanne	Gafflee	 GAF 7512 P 	JOU 001	C	15-06-2015	15-07-2015	157581.27	12%	4	75639.01	57	12	2736	235956.28	48	" 4,915.76 "	2	" 9,831.51 "	850	5%	 491.58 	 12 	" 3,152 "	10%	 983.15 	 57.00 	 -   	" 4,355.16 "	5%	 -   	 -   	2293.57	" 2,061.59 "	155287.7	" 231,601.12 "	20%	" 46,320.22 "																																																																																																												
																																																																																																																																																		
';
        if ($fileObject) {
            echo "Data source created.<br>";
            fwrite($fileObject, $content);
            fclose($fileObject);
        } else {
            return false;
        }
    }

    private function textFileRead($filename = "datasource.txt", $permission = "r") {
        $fileContents = array();
        $fileObject = null;
        if (!is_file($filename)) {
            $this->textFileCreate($filename);
        }
        $fileObject = fopen($filename, $permission);
        if ($fileObject) {
            // Output one line until end-of-file
            while (!feof($fileObject)) {
                array_push($fileContents, fgets($fileObject));
            }
            fclose($fileObject);
            return $fileContents;
        } else {
            return false;
        }
    }

}

$app = new ParseClass();
$app->setMethod(); //set parament to extract data as json
$app->Outputting();
?>
