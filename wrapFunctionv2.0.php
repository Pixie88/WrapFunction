<?php
//wrap function takes 2 parameters string and length
function wrap($string, $length)
{
    echo "To confirm your string is \"" . $string . "\" and your length is " . $length . "\nOutput: \n";
    
    //turn string into array of words
    $words = preg_split('/\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);
    //line length starts at 0
    $lineLen = 0;
    //string to hold output
    $newString = "";

    
    foreach ($words as $word) {
        //work out word length
        $wordLen = strlen($word);
        
        //if wordlength is greater than length it needs to be split up further
        if ($wordLen > $length) {
            $partWord = str_split($word, $length);
            foreach ($partWord as $parts) {
                if ($parts == $partWord[0]) {
                    //first word does not need new line before it, only after
                    //if last char in string is not \n add \n
                    if(substr($newString, -1) != "\n"){
                        $newString .= "\n";
                    }
                    $newString .= "$parts";
                    

                } else {
                    //splitting after first split space needs to go after word
                    
                    $newString .= "\n$parts ";
                    
                }
            }
            //calculate total line length to ensure it is not over the required length
            $lineLen += $wordLen;
        } else /*word is equal to or under maximum line length */ {
            if (($lineLen + $wordLen) <= $length) /*check adding word to line won't make it go over length */{

                if (($lineLen + $wordLen) < $length) {
                    $newString .= "$word ";
                    //add 1 to length to account for space
                    $wordLen += 1;
                } else /*line is going to be too big */{
                    $newString .= $word;
                }
                //recalculate line length
                $lineLen += $wordLen;
            } else {
                //add spaces and add word back into output 
                $newString .= "\n";
                $lineLen = $wordLen + 1;
                $newString .= "$word ";
            }
        }
    }

    return $newString;
}


echo "Hi Sam and Chris! Please enter your chosen string. \n" ;

//assign input to string variable
$string = readline();

    //validation of string variable - must not be null
    while (empty($string)){
        echo "No string was entered, please enter your chosen string\n";
        $string = readline();
    }

echo "Please enter your desired line length. \n"; 

$length = readline();

    //validation of length variable - must not be null 
    while (empty ($length)){
        echo "No length entered, please enter a valid length \n";
        $length = readline();
    }

/*length is currently a string. Need check input is a number,  turn it into an integer and check it is positive
for the purpose of this exercise I shall just turn input into an int. As the question focuses on the function only*/
    
$length = intval($length);

//call wrap function
wrap($string, $length);
    
?>
