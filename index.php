<!DOCTYPE html>
<html>
    <head>
        <title> Silverjack - Team 4 </title>
        <link href="css/styles.css" rel="stylesheet" />
        
        <?php
    
            include 'functions/function1.php';
            
            getHand();
            echo "<br>";
            getHand();
            echo "<br>";
            getHand();
            echo "<br>";
            getHand();
            
            include 'functions/function2.php';
            echo "<hr>";
            $players = displayHands(getDeck());
            displayWinners($players);
            
        ?>
    </head>
    <body>
        

    </body>
</html>