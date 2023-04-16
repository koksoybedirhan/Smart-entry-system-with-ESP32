<?php
    include "libs/db.php";
    include "libs/session.php";
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
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <h5 class="card-title">Temperature <i class="fa-solid fa-temperature-three-quarters fa-fade"></i></h5>
                        <p class="card-text"><?php echo $data["temp"]; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <h5 class="card-title">Humidity <i class="fa-solid fa-droplet fa-fade"></i></h5>
                        <p class="card-text"><?php echo $data["hum"]; ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <?php if(isLoggedin()):?>
                            <br>
                            <?php $result2 = getUser();  while($data2 = mysqli_fetch_assoc($result2)): ?>
                                <img class="card-img-top" src="img/<?=$_SESSION['img']?>" alt="User" height="500">
                                <div class="card-body" style="text-align: center;">
                                    <h5 class="card-title"><?php echo htmlspecialchars($_SESSION["name"])." (".htmlspecialchars($_SESSION["status"]).")";?></h5>
                                    <p class="card-text">Kart Numarası: <?php echo htmlspecialchars($_SESSION["rfid"])?></p>
                                    <a href="profile.php" class="btn btn-primary">Profile</a>
                                </div>
                            <?php endwhile; ?>
                            <?php else: ?>
                                <br>
                                <img class="card-img-top" src="img/user.png" alt="User" height="500">
                                <div class="card-body" style="text-align: center;">
                                    <h5 class="card-title">Son giriş yapan:
                                        <br>Bedirhan Köksoy (Çalışan)</h5>
                                    <p class="card-text">Kart Numarası: 624.367.136.732</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>
</div>
</html>
