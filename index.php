<?php
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: orari.php");
        die();
    }

    include 'config.php';
    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Verifikimi i llogarise u krye me sukses.</div>";
            }
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST['submit'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: orari.php");
            } else {
                $msg = "<div class='alert alert-info'>Verifikoni email-in, dhe me pas provoni perseri.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email-i ose fjalekalimi nuk eshte i sakte.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Orari Mesimor | Hyr</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="logo.png">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="logo.png" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Hyr Tani</h2>
                        <p>per te aksesuar orarin e deges se Informatikes </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Vendosni email-in" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <input type="password" class="password" name="password" placeholder="Vendosni fjalekalimin" style="margin-bottom: 2px;" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Keni harruar fjalekalimin?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Hyr</button>
                        </form>
                        <div class="social-icons">
                            <p>Krijo Llogari! <a href="register.php">Regjistrohu</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    

</body>

</html>