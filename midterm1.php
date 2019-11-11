<?php 
/**
 * @author Nada El Zeini
 * Midterm 1 CS 174
 */
echo <<<_END
		<html><head><title>Finding Greatest Product of 4 Adjacent Numbers</title></head><body>
		<form method="post" action="midterm.php" enctype="multipart/form-data">
			Select a txt File: <input type="file" name = "filename" size = "10" />
			<input type="submit" value="Calculate">
		</form>
_END;

if ($_FILES['filename']['type'] == 'text/plain'){
    echo "<pre>"; 	// Enables display of line feeds
    
    $input = file_get_contents($_FILES['filename']['name']);
    greatestProduct($input);
    echo "</pre>";  // Terminates pre tag
}
else{
    echo "No txt file submitted";
}

function greatestProduct($string)  {
    
    $string=  preg_replace('/\s+/', '', $string);
    $len  = strlen($string);
    if(is_numeric($string) == false){
        
        echo "Illegal file content, only string of numbers are accepted";
    }
    
    else if($len != 400){
        echo "Input not a 400 numbers";
        return;
    }
    else {
        
      
        $array = array();
        for($i = 0 ; $i < strlen($string) ; $i++ ){
            $digit = $string[$i];
            array_push($array,$digit);
        }
                  
            $size = 20;
            $grid = array_chunk($array, $size); //grid is the 20x20 multidimensional array
            $hProd = 0;
            $vProd = 0;
            $prodArray = array();
            foreach ($grid as $row => $list){
                for($j =0 ;$j < sizeof($list)-3 ;  $j ++){
                    $hProd= $list[$j]* $list[$j + 1]* $list[$j +2] * $list[$j +3]; //horizontally left right products
                    array_push($prodArray,$hProd);
                }       
            }
            for($c = 0; $c<20 ; $c++){ //column
               
            for($r = 0; $r<17 ; $r++){ //row
             
                    
                $vProd = $grid[$r][$c]*$grid[$r+1][$c]*$grid[$r+2][$c]*$grid[$r+3][$c];
                array_push($prodArray,$vProd);
                }
            }
            $diagArray = array();
            $diagUpProd=0;
            $diagDownProd = 0;
            for($row = 0; $row< 20; $row++){
            for($col = 0 ; $col < 20 ;$col++){
                //first all diagonals going upwards from every number
                if(($col< 17) && ($row >=3)){
                        $diagUpProd = $grid[$row][$col]*$grid[$row-1][$col+1]*
                                     $grid[$row-2][$col+2]*$grid[$row-3][$col+3];
                    
                  array_push($prodArray,$diagUpProd);
                }
                //second all diagonals going downwards from every number
                if(($row<= 16) && ($col<=16)){
                   $diagDownProd = $grid[$row][$col]*$grid[$row+1][$col+1]*
                    $grid[$row+2][$col+2]*$grid[$row+3][$col+3];
                    array_push($prodArray,$diagDownProd);
                }
                }
            }
            $max = max($prodArray);
           echo "greatest product of 4 adjacent numbers in any direction is $max";
    }
                         
        
}

function testerFunction(){
    echo nl2br("\n");
    echo nl2br("Testing function that returns greatest product of 4 adjacent number: \n");
   
    echo nl2br("\n");
    $input = "71636269561882670428
858615607891129494 95 
65727333001053367881
52584907711670556013
53697817977846174064
83972241375657056057
82166370484403199890
96983520312774506326
12540698747158523863
66896648950445244523
05886116467109405077
16427171479924442928
17866458359124566529
24219022671055626321
07198403850962455444
84580156166097919133
62229893423380308135
73167176531330624919
30358907296290491560
70172427121883998797";
    echo "Testing a 400 number string with spaces, result is: ";
    greatestProduct($input);
    echo nl2br("\n");
    echo nl2br("\n");
    $input ="123523534634cs174";
    
    echo "Testing characters in input $input result is " ;
    greatestProduct($input);
    echo nl2br("\n");
    $input = "71636269561882670428252483600823257530420752963450
85861560789112949495459501737958331952853208805511
65727333001053367881220235421809751254540594752243
52584907711670556013604839586446706324415722155397
53697817977846174064955149290862569321978468622482
83972241375657056057490261407972968652414535100474
82166370484403199890008895243450658541227588666881
96983520312774506326239578318016984801869478851843
12540698747158523863050715693290963295227443043557
66896648950445244523161731856403098711121722383113
05886116467109405077541002256983155200055935729725
16427171479924442928230863465674813919123162824586
17866458359124566529476545682848912883142607690042
24219022671055626321111109370544217506941658960408
07198403850962455444362981230987879927244284909188
84580156166097919133875499200524063689912560717606
62229893423380308135336276614282806444486645238749
73167176531330624919225119674426574742355349194934
30358907296290491560440772390713810515859307960866
70172427121883998797908792274921901699720888093776111111111111111111111111";
    echo "Testing input more than 400 numbers, result is: ";
    greatestProduct($input);
    echo nl2br("\n");
    $input = "12344356";
    echo "Testing less than 400 numbers, result is: ";
    greatestProduct($input);
    echo nl2br("\n");
    $input = "";
    echo "Testing empty string, result is: ";
    greatestProduct($input);
    echo nl2br("\n");
    echo "Testing numbers result is: ";
    greatestProduct(716362695618826704282524836008232575304207529634585861560789112949495459501737958331952853208805511657273330010533678812202354218097512545405947522435258490771167055601360483958644670632441572215539753697817977846174064955149290862569321978468622482839722413756570560574902614079729686524145351004748216637048440319989000889524345065854122758866688196983520312774506326239578318016984801869478851843125406987471585238630507156932909632952274430435576689664895044524452316173185640309871112172238311305886116467109405077541002256983155200055935729725164271714799244429282308634656748139191231628245861786645835912456652947654568284891288314260769004224219022671055626321111109370544217506941658960408071984038509624554443629812309878799272442849091888458015616609791913387549920052406368991256071760662229893423380308135336276614282806444486645238749731671765313306249192251196744265747423553491949343035890729629049156044077239071381051585930796086670172427121883998797908792274921901699720888093776);
    
    
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    






