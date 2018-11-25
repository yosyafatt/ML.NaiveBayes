<?php 
    require 'naivebayes.php';

    $data = olahData(getData("dt_training.txt"));    
    
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Näive Bayes Classifier</title>

    <!-- Bootstrap -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/css/bootstrap-narrow.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="header clearfix">            
            <h3 class="text-muted">Näive Bayes Classifier</h3>
        </div>
        
        <div class="row">
            <form method="post">
                <div class="form-group">                    
                    <div class="col-md-4">
                        <label for="weather">Pilih kondisi cuaca :</label>                        
                        <select name="weather" id="in_weather" class="form-control">
                            <option value="">None</option>
                            <option value="Cerah">Cerah</option>
                            <option value="Hujan">Hujan</option>
                        </select>                        
                    </div>
                    <div class="col-md-4">
                        <label for="temperature">Pilih tingkat temperatur :</label>
                        <select name="temperature" id="in_temperature" class="form-control">
                            <option value="">None</option>
                            <option value="Normal">Normal</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="wind">Pilih kecepatan angin :</label>
                        <select name="wind" id="in_wind" class="form-control">
                            <option value="">None</option>
                            <option value="Pelan">Pelan</option>
                            <option value="Kencang">Kencang</option>
                        </select>
                    </div>                                                            
                    <div class="col-md-12" style="margin : 30px 0">
                        <button class="btn btn-primary btn-block" type="submit">Go!</button>                            
                    </div>                        
                </div>                
            </form>
        </div>
        
        <?php
        if (isset($_POST)) {
            $data_test = @[$_POST['weather'], $_POST['temperature'] ,$_POST['wind']];

            $nb = new NaiveBayes($data, ["Weather", "Temperatur", "Wind"]);
        
            $result = $nb->run()->predict($data_test);
            
            ?>
            
        <div class="row">            
            <div class="col-md-6">
                <pre>
                    <?php print_r($result); ?>
                </pre>
            </div>
            <div class="col-md-6">
                <label>Apakah akan berolahraga ?</label>
                <?= array_keys($result)[0] ?>
            </div>
        </div>

        <?php            
        }        
        ?>
        
        
                

        <footer class="footer">
            <p>&copy; Yosyafat, 030</p>
        </footer>

    </div> <!-- /container -->

    <!-- jQuery Slim (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./bootstrap/js/jquery.slim.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
