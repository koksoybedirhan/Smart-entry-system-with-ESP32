<?php
    include "libs/db.php";
    include "libs/funcitons.php";

    $temperature = $humidity = "";

    if(!empty($_GET['temp']) && !empty($_GET['hum']))
    {
        $temperature = $_GET['temp'];
        $humidity = $_GET['hum']; 
        $query = "INSERT INTO veri (temp, hum) VALUES ('$temperature', '$humidity')";
        $result = mysqli_query($baglanti, $query);
    }

    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on")
    {
        $url = "https://";
    }
    else{
        $url = "http://";
        $url.=$_SERVER['HTTP_HOST'];
        $url.=$_SERVER['REQUEST_URI'];
        $url;
    }
    $page = $url;
    $sec = "9";
?>

<?php include "parts/header.php"; ?>
<?php include "parts/navbar.php"; ?>
<div>

    <div class="container my-3">
        <div class="row">
        <?php $result = getData();  while($data = mysqli_fetch_assoc($result)): ?>
            <div class="col-6">
                <div class="card-deck">
                    <div class="card">
                        <img class="card-img-top" src="img/temperature.jpeg" alt="Temperature" width="50" height="450">
                        <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">Temperature</h5>
                        <h6 class="card-text" style="text-align: center; font-size:50px;"><?php echo $data["temp"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-deck">
                    <div class="card">
                        <img class="card-img-top" src="img/humidity.jpeg" alt="Temperature" width="50" height="450">
                        <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">Humidity</h5>
                        <h6 class="card-text" style="text-align: center; font-size:50px;"><?php echo $data["hum"]; ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>
</div>
</html>
