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
                        <img class="card-img-top" src="img/user.png" alt="User" height="500">
                        <div class="card-body" style="text-align: center;">
                            <h5 class="card-title">Bedirhan Köksoy (Çalışan)</h5>
                            <p class="card-text">Kart Numarası: 624.367.136.732</p>
                            <a href="profile.php" class="btn btn-primary">Profil</a>
                        </div>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>
</div>
</html>