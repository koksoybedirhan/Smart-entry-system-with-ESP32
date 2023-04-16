<?php
    include "libs/db.php";
    include "libs/session.php";
    include "libs/funcitons.php";
?>

<?php include "parts/header.php"; ?>
<?php include "parts/navbar.php"; ?>
<div>

    <div class="container my-3">
        <div class="card">
            <div class="row">
                <div class="col-3"></div>
                    <div class="col-6">
                        <br>
                        <?php $result2 = getUser();  while($data2 = mysqli_fetch_assoc($result2)): ?>
                        <img class="card-img-top" src="img/<?=$_SESSION['img']?>" alt="User" height="500">
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title"><?php echo htmlspecialchars($_SESSION["name"])." (".htmlspecialchars($_SESSION["status"]).")";?></h5>
                            <p class="card-text">Kart Numarası: <?php echo htmlspecialchars($_SESSION["rfid"])?></p>
                            <a href="profile.php" class="btn btn-primary">Profile</a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>
</div>
</html>
