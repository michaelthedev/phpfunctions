<?php
// +------------------------------------------------------------------------+
// | @author 		: Michael Arawole (HENT Technologies)
// | @author_url	: https://logad.net
// | @author_email	: henttech@gmail.com   
// +------------------------------------------------------------------------+
// | Date : 31st May 2020
// +------------------------------------------------------------------------+

## Useful Custom PHP functions ##

//Generate random strings
function GenerateString($minlength = 20, $maxlength = 20, $uselower = true, $useupper = true, $usenumbers = true, $usespecial = false) {
        $charset = '';
        if ($uselower) {
            $charset .= "abcdefghijklmnopqrstuvwxyz";
        }
        if ($useupper) {
            $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        }
        if ($usenumbers) {
            $charset .= "123456789";
        }
        if ($usespecial) {
            $charset .= "~@#$%^*()_+-={}|][";
        }
        if ($minlength > $maxlength) {
            $length = mt_rand($maxlength, $minlength);
        } else {
            $length = mt_rand($minlength, $maxlength);
        }
        $key = '';
        for ($i = 0; $i < $length; $i++) {
            $key .= $charset[(mt_rand(0, strlen($charset) - 1))];
        }
        return $key;
}


//Pretty Time (1min ago)
function nicetime($date,$timezone="Africa/Lagos") {
        // Validate
        if( !isset($date) && !strtotime($date) ) {
            return "Improper Parameter.";
        } else {

        // Variables
        date_default_timezone_set($timezone);
        $now = time();
        $date = $date;
        
        $periods = array(
            array("second", 1),
            array("minute", 60),
            array("hour", 60),
            array("day", 24),
            array("week", 7),
            array("month", 4.35),
            array("year", 12)
        );

        // Future or Past
        if( $now > $date ) {
            $difference = $now - $date;
            $tense = "ago";
        }

        // Present
        if( $difference < 900 ) { return "now"; }

        
        // Safe Variable to Calculate
        $figure = $difference;

        // Calculate
        for( $index = 1; ($figure >= 1 && ($figure / $periods[$index][1]) >= 1) && $index < count($periods); $index++ ) {
            // Debug / Testing
           

            // Figure
            $figure /= $periods[$index][1];

            // Plurality Check
            if( $figure != 1) { $periods[$index][0].="s"; }
        }
        
        // Result
        return round($figure)." ".$periods[$index-1][0]." ".$tense;
        }
}

//Generate OTP (numbers only)
function generateOTP($n) { 
        // Take a generator string which consist of 
        // all numeric digits 
        $generator = "1357902468"; 
      
        // Iterate for n-times and pick a single character 
        // from generator and append it to $result 
          
        // Login for generating a random character from generator 
        //     ---generate a random number 
        //     ---take modulus of same with length of generator (say i) 
        //     ---append the character at place (i) from generator to result 
      
        $result = ""; 
      
        for ($i = 1; $i <= $n; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
      
        // Return result 
        return $result; 
}


//More to come :D
