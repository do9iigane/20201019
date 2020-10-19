<?php

Class Nabeatsu {
    public static function shout($count){

        if($count <1){
            echo "引数に出力回数を数値で指定してください｡ ex) php test3.php 40";
            return;
        }
        $n = 1;
        while($n<=$count){
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
    }
}

Nabeatsu::shout($argv[1]);
