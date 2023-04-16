<style>
    button:hover
    {
        color: black;
        background: white;
        border-radius: 5px;
        border: 1px solid black;
    }
</style>

<body>
<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                <li><a href="./index.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Ana Sayfa</button></a></li>
                <li><a href="./logUsers.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Üye Veri Kayıtları</button></a></li>
                <li><a href="./logs.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Ortam Veri Kayıtları</button></a></li>
                
            </ul>

            <div class="text-end">
                
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                <?php if(isLoggedin()):?>

                    <li><a href="./profile.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Profile</button></a></li>
                    <li><a href="./logout.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Logout</button></a></li>

                <?php else:?>

                    <li><a href="./login.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Login</button></a></li>
                    <li><a href="./register.php" class="nav-link px-2 text-white"><button class="btn btn-outline-light me-2">Register</button></a></li>

                <?php endif;?>
            </div>
        </div>
    </div>
</header>
</body>
