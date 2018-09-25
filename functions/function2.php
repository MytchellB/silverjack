<?php
    session_start();
    $startSec = microtime(true);

    function getDeck() {
        $deck = array();
        $suits = array("clubs","spades","hearts","diamonds");

        for ($i = 0; $i < 4; $i++){
            for ($u = 1; $u <= 13; $u++){
                $deck[] = $suits[$i] . " " . $u;
            }
        }

        return $deck;
    }

    function displayHands($deck) {
        $randInd = range(0, 3);
        $names = array("Mytchell", "Jorge", "Conner", "Lexi");
        $players = array("Mytchell" => 0, "Jorge" => 0, "Conner" => 0, "Lexi" => 0);
        
        shuffle($randInd);
        
        for ($i = 0; $i < 4; $i++) {
            $playerTotal = 0;
            echo $names[$randInd[$i]];
            while ($playerTotal <= 35) {
                shuffle($deck);
                $card = array_pop($deck);
                $card_suit = substr($card, 0, strpos($card, " "));
                $card_val = intval(substr($card, (strpos($card, ' ') + 1), strlen($card)));
                echo "<img src='cards/$card_suit/" . $card_val . ".png'>";
                $playerTotal += $card_val;
            }
            $players[$names[$randInd[$i]]] = $playerTotal;
            echo $players[$names[$randInd[$i]]] . "<br>";
        }
        
        return $players;
    }

    function displayWinners($players) {
        $winners = array();
        $check = false;
        foreach ($players as $key => $value) {
            if ($value == 42) {
                $check = true;
                break;
            }
        }

        if (!$check) {
            $min = min($players);
        } else {
            $min = 42;
        }

        foreach($players as $key => $value) {
            if ($value >= $min && $value <= 42) {
                $min = $value;
            }
        }

        $winnerTotal = 0;
        foreach($players as $key => $value) {
            if ($min == $value && $min <= 42) {
                array_push($winners, $key);
            }
            else if ($min <= 42) {
                $winnerTotal += $value;
            }
        }

        if (count($winners) == 0) {
            echo "Nobody wins";
        }
        else {
            if (count($winners) == 1) {
                echo $winners[0] . " wins ";
            }
            else {
                for ($i = 0; $i < count($winners)-1; $i++) {
                    echo $winners[$i] . ", ";
                }
                echo $winners[count($winners)-1] . " win ";
            }
            echo $winnerTotal . " points!";
        }
        echo "<br>";
    }

    function displayElapsedTime() {
        global $startSec;
        echo "Elapsed Time: ";
        $elapsedTime = microtime(true) - $startSec;
        echo $elapsedTime;
        echo "<br>";

        if (!isset($_SESSION["avgSec"])) {
            $_SESSION["avgSec"] = $elapsedTime;
        }
        else {
            $_SESSION["avgSec"] += $elapsedTime;
        }

        if (!isset($_SESSION["gameCount"])) {
            $_SESSION["gameCount"] = 1;
        }
        else {
            $_SESSION["gameCount"]++;
        }

        echo "Avg Elapsed Time: ";
        echo $_SESSION["avgSec"]/$_SESSION["gameCount"];
        echo "<br>";

        echo "# of games played: ";
        echo $_SESSION["gameCount"];
    }
?>
