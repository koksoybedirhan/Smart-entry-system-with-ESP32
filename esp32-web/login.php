<?php
    include "libs/funcitons.php";
    require "libs/session.php";
    require "libs/db.php";
    
    if(isLoggedin()) {
        header("location: profile.php");
        exit;
    }

    $name =  $password = "";
    $nameerr = $passworderr = $loginerr= "";

    if (isset($_POST["login"])) {

        if(empty(trim($_POST["name"]))) {
            $nameerr = "Kullanıcı adı girmelisiniz.";
        } else {
            $name = trim($_POST["name"]);
        }

        if(empty(trim($_POST["password"]))) {
            $passworderr = "Parola girmelisiniz.";
        } else {
            $password = trim($_POST["password"]);
        }

        if(empty($name_err) && empty($password_err)) {
            $sql = "SELECT id, name, password, rfid, img, status FROM user WHERE name = ?";

            if($durum = mysqli_prepare($baglanti, $sql)) {

                $uparam = $name;
                
                mysqli_stmt_bind_param($durum, "s", $uparam);

                if(mysqli_stmt_execute($durum)) {
                    mysqli_stmt_store_result($durum);

                    if(mysqli_stmt_num_rows($durum) == 1) {
  
                        mysqli_stmt_bind_result($durum, $id, $name, $password, $rfid, $img, $status);
                        if(mysqli_stmt_fetch($durum)) 
                        {            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["name"] = $name;
                            $_SESSION["rfid"] = $rfid;
                            $_SESSION["img"] = $img;
                            $_SESSION["id"] = $id;
                            $_SESSION["status"] = $status;

                            header("location: profile.php");
                        } 
                    } else {
                        $loginerr = "Yanlış kullanıcı adı girdiniz.";
                    }
                } else {
                    $loginerr = "Bİlinmeyen bir hata oluştu.";
                }
                mysqli_stmt_close($durum);
            }
        }

        mysqli_close($baglanti);
    }

?>

<?php include "parts/header.php"?>
<div>
    <?php include "parts/navbar.php"; ?>
    <br>

    <?php
    if(!empty($loginerr)) {
        echo '<div class="alert alert-danger">'.$loginerr.'</div>';
    }
    ?>

    <div class="container">
    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Kullanıcı Adı</label>
                                <input type="text" name="name" id="name" class="form-control <?php echo (!empty($nameerr)) ? 'is-invalid': ''?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $nameerr ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Parola</label>
                                <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passworderr)) ? 'is-invalid': ''?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $passworderr ?></span>
                            </div>

                            <input type="submit" name="login" value="Submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <?php include "parts/footer.php" ?>
</div>
</html>