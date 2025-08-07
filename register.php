<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: orari.php");
        die();
    }

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    include 'config.php';
    $msg = "";
    

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        $code = mysqli_real_escape_string($conn, md5(rand()));

        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - Ky email eshte ekzistent tashme.</div>";
        } else {
            if ($password === $confirm_password) {
                $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = 2;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'example@gmail.com';                     //SMTP username
                        $mail->Password   = 'exzq nuiy okxz fmfo';                               //SMTP password
                        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('orari@mesimor.com');
                        $mail->addAddress($email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Orari Mesimor';
                        $mail->Body    = 'Klikoni mbi kete link per te verifikuar llogarine tuaj <b><a href="https://orarimesimors2.000webhostapp.com/?verification='.$code.'">https://orarimesimors2.000webhostapp.com/?verification='.$code.'</a></b>';

                        $mail->send();
                        echo 'Mesazhi u dergua';
                    } catch (Exception $e) {
                        echo "Mesazhi nuk mund te dergohet. Gabimi i postes: {$mail->ErrorInfo}";
                    }
                    echo "</div>";
                    $msg = "<div class='alert alert-info'>Linku i verifikimit sapo u dergua ne adresen tuaj te Email-it</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>Dicka shkoi gabim!</div>";
                }
            } else {
                $msg = "<div class='alert alert-danger'>Fjalekalimet nuk perputhen!</div>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Orari Mesimor | Regjistrohu</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
    content="Login Form" />
    <link rel="icon" href="logo.png">
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
                            <img src="images/image2.svg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Regjistrohu Tani</h2>
                        <p>per te aksesuar orarin e deges se Informatikes</p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Vendosni emrin" value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <input type="email" class="email" name="email" placeholder="Vendosni email-in" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <input type="password" class="password" name="password" placeholder="Vendosni fjalekalimin" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <input type="password" class="confirm-password" name="confirm-password" placeholder="Konfirmoni fjalekalimin tuaj" required oninvalid="this.setCustomValidity('Plotesoni vendin bosh.')" oninput="this.setCustomValidity('')">
                            <button name="submit" class="btn" type="submit">Regjistrohu</button>
                        </form>
                        <div class="social-icons">
                            <p>Keni nje Llogari! <a href="index.php">Hyr</a>.</p>
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
