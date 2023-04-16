<?php
    include "libs/db.php";
    include "libs/session.php";
    include "libs/funcitons.php";
?>

<?php include "parts/header.php"; ?>
<?php include "parts/navbar.php"; ?>
<div>
    
    <div class="container my-3">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <h3 style="text-align: center;">All Entries</h3>
                    <?php $result = getAllUsers();  while($data = mysqli_fetch_assoc($result)): ?>
                        <h6 style="text-align: center; font-size:20px;"><?php echo "Name: ".$data["name"]."- Card ID: ".$data["rfid"]." /Status: ".$data["status"]; ?></h6>
                    <?php endwhile;?>
                </div>
            </div>
            <div class="col-4" style="text-align: center;">
                <h5>Click to show users with excel file.</h5>
                <form action="csvUser.php" method="POST">
                    <input type="submit" name="blog-create" id="submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>
</div>
</html>