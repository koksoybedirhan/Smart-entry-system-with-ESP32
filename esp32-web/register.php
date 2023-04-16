<?php
    include "libs/db.php";
    include "libs/funcitons.php";
    include "libs/session.php";

    $name = $rfid = $password = $status = $confpassword = "";
    $nameerr = $rfiderr = $passworderr = $statuserr = $confpassworderr = "";

    if (isset($_POST["register"])) {
        
        //username
        if(empty(trim($_POST["name"])))
        {
            $ameerr = "Kullanıcı adı girmelisiniz.";
        } 
        elseif (strlen(trim($_POST["name"])) < 3 or strlen(trim($_POST["name"])) > 24) 
        {
            $nameerr = "Kullanıcı adı 5-25 karakter arasında olmalıdır.";
        }
        else
        {
            $sql = "SELECT id FROM user WHERE name = ?";

            if($durum = mysqli_prepare($baglanti, $sql)) 
            {
                $uparam = trim($_POST["name"]);
                mysqli_stmt_bind_param($durum, "s", $uparam);

                if(mysqli_stmt_execute($durum)) {
                    mysqli_stmt_store_result($durum);

                    if(mysqli_stmt_num_rows($durum) == 1) {
                        $nameerr = "Kullanıcı adı daha önce alınmış.";
                    } else {
                        $name = $_POST["name"];
                    }
                } else {
                    echo mysqli_error($baglanti);
                    echo "Hata var.";
                }
            }

            $username = $_POST["name"];
        }

        //rfid
        if(empty(trim($_POST["rfid"])))
        {
            $rfiderr = "RF ID adresi girmelisiniz.";
        }
        elseif (strlen(trim($_POST["rfid"])) < 2 or strlen(trim($_POST["rfid"])) > 39) 
        {
            $rfiderr = "RF ID 2-40 karakter arasında olmalıdır.";
        }
        else
        {
            $sql = "SELECT id FROM user WHERE rfid = ?";

            if($durum = mysqli_prepare($baglanti, $sql)) {
                $mparam = trim($_POST["rfid"]);
                mysqli_stmt_bind_param($durum, "s", $mparam);

                if(mysqli_stmt_execute($durum)) {
                    mysqli_stmt_store_result($durum);

                    if(mysqli_stmt_num_rows($durum) == 1) {
                        $rfiderr = "RF ID adresi daha önce alınmış.";
                    } else {
                        $rfid = $_POST["rfid"];
                    }
                } else {
                    echo mysqli_error($baglanti);
                    echo "Hata var.";
                }
            }

            $mail = $_POST["rfid"];
        }

        //status
        if(empty(trim($_POST["status"])))
        {
            $statuserr = "Statü girmelisiniz.";
        }
        elseif (strlen(trim($_POST["status"])) < 1 or strlen(trim($_POST["status"])) > 30) 
        {
            $statuserr = "Statü 2-40 karakter arasında olmalıdır.";
        }
        else
        {
            $status = $_POST["status"];
        }

        //password
        if(empty(trim($_POST["password"])))
        {
            $passworderr = "Parola girmelisiniz.";
        }
        elseif (strlen(trim($_POST["password"])) < 5 or strlen(trim($_POST["password"])) > 19) 
        {
            $passwordrerr = "Parola 5-20 karakter arasında olmalıdır.";
        }
        else
        {
            $password = $_POST["password"];
        }

        //confpassword
        if(empty(trim($_POST["password"])))
        {
            $confpassworderr = "Parola girmelisiniz.";
        }
        else
        {
            $confpassword = $_POST["confpassword"];
            if ($password != $confpassword)
            {
                $confpassworderr = "Parolalar eşleşmiyor";
            }
        }

        //veritabanı
        if(empty($nameerr) && empty($rfiderr) && empty($statuserr) && empty($passworderr))
        {
            $sql = "INSERT INTO user (name, rfid, status, password) VALUES (?,?,?,?)";
            
            if($durum = mysqli_prepare($baglanti, $sql))
            {
                $uparam = $name;
                $nparam = $rfid;
                $dparam = $status;
                $pparam = $password;

                mysqli_stmt_bind_param($durum, "ssss", $uparam, $nparam, $dparam, $pparam);

                if(mysqli_stmt_execute($durum))
                {
                    header("location: login.php");
                }
                else
                {
                    echo mysqli_error($baglanti);
                    echo "Hata var.";
                }
            }
        }
    }
?>

<?php include "parts/header.php"?>
<div>
    <?php include "parts/navbar.php" ?>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="register.php" method="POST" novalidate>

                            <div class="mb-3">
                                <label for="name" class="form-label">Kullanıcı Adı</label>
                                <input type="text" name="name" id="name" class="form-control <?php echo (!empty($nameerr)) ? 'is-invalid': ''?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $nameerr ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="rfid" class="form-label">RF ID Adresi</label>
                                <input type="rfid" name="rfid" id="rfid" class="form-control <?php echo (!empty($rfiderr)) ? 'is-invalid': ''?>" value="<?php echo $rfid; ?>">
                                <span class="invalid-feedback"><?php echo $rfiderr ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Statü</label>
                                <input type="status" name="status" id="status" class="form-control <?php echo (!empty($statuserr)) ? 'is-invalid': ''?>" value="<?php echo $status; ?>">
                                <span class="invalid-feedback"><?php echo $statuserr ?></span>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                    <label for="password" class="form-label">Parola</label>
                                    <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passworderr)) ? 'is-invalid': ''?>" value="<?php echo $password; ?>">
                                    <span class="invalid-feedback"><?php echo $passworderr ?></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                    <label for="confpassword" class="form-label">Parola Tekrar</label>
                                    <input type="password" name="confpassword" id="confpassword" class="form-control <?php echo (!empty($confpassworderr)) ? 'is-invalid': ''?>" value="<?php echo $confpassword; ?>">
                                    <span class="invalid-feedback"><?php echo $confpassworderr ?></span>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="register" id="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include "parts/footer.php" ?>
</div>
</html>