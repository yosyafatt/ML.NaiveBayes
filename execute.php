<?php 
    require 'naivebayes.php';

    $data = olahData(getData("dt_training.txt"));    
    
    $data_test = ["Cerah","Normal","Kencang"];

    $nb = new NaiveBayes($data, ["Weather", "Temperatur", "Wind"]);

    print_r($nb->run()->predict($data_test));
    
    function getData($file){
        $fh = fopen($file, "r");
        $i = 0;
    
        while (!feof($fh)) {
            $line[$i] = fgets($fh);
            $i++;
        }
               
        fclose($fh);
        return $line;
    }
    
    function olahData($data){
        $i = 0;
        $olah = null;
        foreach ($data as $d) {
            $olah[$i] = array_map("trim", explode(" ", $d));        
            $i++;
        }
        
        return $olah;
    }    
?>