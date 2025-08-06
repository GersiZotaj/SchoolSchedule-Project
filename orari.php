<?php
    session_start();
    if (!isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: index.php");
        die();
    }

    include 'config.php';
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="logo.png">
  <title>Orari Mesimor | Faqja kryesore</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
    <div id="loader"></div>
    
  <header>
    <img src="moon.png" id="icon" class="noSelect">
    <div class="background"></div>
    <div class="logo"><a class="noSelect" href="https://uvms.univlora.edu.al/user/login"><img src="logouv.png" id="logo"></a></div>
    <button class="right-button"><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>&nbspDil</a></button>
  </header>



<h1 align=center size=20px class="heading"> Orari Mësimor</h1>
<p id="date"></p>
<p id="greet" align=center size=18px class="greeting"> Pershendetje, <?php 
$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        echo $row['name'] ;
    }
        ?> 
        !</p>

<br>
<link rel="stylesheet" href="orari/design.css">
<div class="tabs">
    <div class="tab-header">
      <div class="active">
        Dita 1 (H)
      </div>
      <div>
        Dita 2 (R)
      </div>
      <div>
        Dita 3 (M)
      </div>
      <div>
        Dita 4 (E)
      </div>
      <div>
        Dita 5 (P)
      </div>
    </div>
    <div class="tab-content">
      <div class="active">
        <h2>E HËNË</h2>
        <pre>1.Arkitekture Kompjuterike <div class="ngjyra"> 09:00-10:00 
 (Leksion, Salla C002) </div>
<br>
2.Arkitekture Kompjuterike <div class="ngjyra"> 10:00-12:00 
 (Seminar, Salla C402) </div>
<br>
3.Projketimi i Nderfaqeve (VB.net) <div class="ngjyra"> 12:00-15:00
 (Leksion, Salla C402) </div>
<br>
            </pre>
      </div>
      <div>
        <h2>E MARTË</h2>
        <pre>1.Kriptografi <div class="ngjyra"> 08:00-11:00
 (Leksion, Salla C302) </div>
 <br>
2.Projketimi i Nderfaqeve (VB.net) <div class="ngjyra"> 12:00-14:00
 (Seminar, Salla C402) </div>
</pre>
      </div>
      <div>
        <h2>E MËRKURË</h2>
        <pre>-- nuk ka --
        </pre>
      </div>
      <div>
        <h2>E ENJTE</h2>
        <pre>1.Kriptografi <div class="ngjyra"> 13:00-15:00
 (Seminar, Salla C402)</div>
        </pre>
      </div>
      <div>
        <h2> E PREMTE</h2>
        <pre>1.Arkitekture Kompjuterike <div class="ngjyra"> 12:00-14:00
 (Leksion, Salla C102)</div>
        </pre>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="orari/finish.js"></script>
  
  <script>
      function showDateTime() {
            var today = new Date();
            var days = ['E Diel', 'E Hënë', 'E Martë', 'E Mërkurë', 'E Enjte', 'E Premte', 'E Shtunë'];
            var day = days[today.getDay()];
            var date = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();

            
            if (date < 10) {
                date = '0' + date;
            }
            if (month < 10) {
                month = '0' + month;
            }

            var fullDate = day + ', ' + date + '/' + month + '/' + year;
            document.getElementById('date').innerText = fullDate;
        }

        
        showDateTime();
  </script>
  
</body>