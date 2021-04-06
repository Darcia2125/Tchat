<?php
    $bdd = new PDO("mysql:host=127.0.0.1;dbname=tchat;charset=utf8", "root", "");
    $allmsg = $bdd->query('SELECT * FROM message ORDER BY id DESC');
     while($msg = $allmsg->fetch())
     {
?>
    <b><?php echo $msg['pseudo']; ?> :</b> <?php echo $msg['sms']; ?> <br />
        <?php
            }
        ?>