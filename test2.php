<?php
$n = 1;

while($n<=40){
    switch(true){
        case ($n-intval($n/10)*10)==3:
        case intval($n/10)==3:
        case ($n % 3) == 0:
            echo "アホ\n";
            break;
        default:
            echo "{$n}\n";
            break;
    }
    $n++;
}
