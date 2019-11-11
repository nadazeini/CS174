
<?php
/**
 * @author Nada El Zeini
 * @param $n number to test
 * @return string
 */
function prime_function($n){
 $str ="";
    for($i = 2 ; $i <= $n ; $i++){
        $isPrime = true;
        for($j = 2 ; $j <= $i/2 ; $j++){
            if($i % $j == 0){
                $isPrime = false;
                break;
            }
            
        }
        if($isPrime == true){
            if($i == 2){
               $str.= "$i";
            }
            else
            $str.= ", $i";
        }
    }
            echo $str;
        return "$str";
        
}
/**
 * Tester function
 */
function tester_function(){
    $test=1;
    $n = 0;
    echo "#$test result is: ";
  $result = prime_function($n);
    if($result == ""){
         echo "<br>#$test TEST PASSED for $n <br><br>"  ;
      
    }
    else{
        echo "<br>#$test TEST FAILED for $n <br><br>"   ;
    }
    $test++;
    $n =2;
    echo "#$test result is: ";
    $result = prime_function($n);
    if( $result == "2"){
        echo "<br>#$test TEST PASSED for $n <br><br>"  ;
    }
    else{
        echo "<br>#$test TEST FAILED for $n <br><br>"   ;
    }

    $test++;
    $n = 10;
    echo "#$test result is: ";
    $result = prime_function($n);
    if($result == "2, 3, 5, 7"){
        echo "<br>#$test TEST PASSED for $n <br><br>"  ;
    }
    else{
        echo "<br>#$test TEST FAILED for $n <br><br>"   ;
    }
    
    $test++;
    $n = 23;
    echo "#$test result is: ";
    $result = prime_function($n);
    if($result == "2, 3, 5, 7, 11, 13, 17, 19, 23"){
        echo "<br>#$test TEST PASSED for $n <br><br>"  ;
    }
    else{
        echo "<br>#$test TEST FAILED for $n <br><br>"   ;
       
    }
    $test++;
    $n = 99;
    echo "#$test result is: ";
    $result = prime_function($n);
    if($result == "2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97"){
        echo "<br>#$test TEST PASSED for $n <br><br>"  ;
    }
    else{
        echo "<br>#$test TEST FAILED for $n <br><br>"   ;
    }
}

        ?>
        