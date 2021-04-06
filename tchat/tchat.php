<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=tchat;charset=utf8", "root", "");

if(isset($_POST['pseudo']) AND isset($_POST['sms']) AND !empty($_POST['pseudo']) AND !empty($_POST['sms']))
{
    $pseudo= htmlspecialchars ($_POST['pseudo']);
    $sms= htmlspecialchars ($_POST['sms']);
    $insertmsg= $bdd->prepare('INSERT INTO message(pseudo, sms) VALUES (?,?)');
    $insertmsg-> execute(array($pseudo,$sms));
}

?>
<html>
    <head>
        <title> TCHAT </title>
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </head>
    <body>
        <form method="post" action="">
            <input type="text" name="pseudo" placeholder="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo; } ?> "/><br />
            <textarea type="text" name="sms" placeholder="sms"></textarea><br />
            <input type="submit" value="ENVOYER" />
        </form>
        <div id="message">
            <?php
            $allmsg = $bdd->query('SELECT * FROM message ORDER BY id DESC');
            while($msg = $allmsg->fetch())
            {
            ?>
            <b><?php echo $msg['pseudo']; ?> :</b> <?php echo $msg['sms']; ?> <br />
            <?php
            }
            ?>
        </div>
        <script>
            setInterval('load_message()', 500);
            function load_message() {
                $('#message').load('load_message.php')
            }
        </script>
    </body>
</html>