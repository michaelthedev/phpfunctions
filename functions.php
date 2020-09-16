<?php
// +------------------------------------------------------------------------+
// | @author 		: Michael Arawole (HENT Technologies)
// | @author_url	: https://logad.net
// | @author_email	: henttech@gmail.com   
// +------------------------------------------------------------------------+
// | Last Updated : 16th Sep 2020
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

// Hide emails (http://www.maurits.vdschee.nl/php_hide_email/)
function hide_email($email)

{ $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

  $key = str_shuffle($character_set); $cipher_text = ''; $id = 'e'.rand(1,999999999);

  for ($i=0;$i<strlen($email);$i+=1) $cipher_text.= $key[strpos($character_set,$email[$i])];

  $script = 'var a="'.$key.'";var b=a.split("").sort().join("");var c="'.$cipher_text.'";var d="";';

  $script.= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';

  $script.= 'document.getElementById("'.$id.'").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

  $script = "eval(\"".str_replace(array("\\",'"'),array("\\\\",'\"'), $script)."\")"; 

  $script = '<script type="text/javascript">/*<![CDATA[*/'.$script.'/*]]>*/</script>';

  return '<span id="'.$id.'">[javascript protected email address]</span>'.$script;

}

// Convert normal array to object array
function convert_to_object($array){
        $object = (object) $array;
        return $object;
}


// Detect xhr / Allow only xhr (XmlHttpRequest)
function onlyxhr(){
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
                // not xhr //
                // http_response_code(404);
                // exit;
            }
        } 
        else {
            // not xhr //
            // http_response_code(404);
            / exit;
        }
}

// Log error / messages to cutom file
function log_error($message){
        $message = "[".gmdate("M d Y H:i:s")."] \r\n".$message."\r\n";
        error_log(PHP_EOL.$message,3,'./api_errors.log');       
}

// Get URL contents using curl (with file_get_contents fallback)
function get_content($url){
	if (function_exists('curl_version')) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_SSL_VERIFYPEER => false
                ));
                // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                $result = curl_exec($curl);
                curl_close($curl);
        }
        else{
                $arrContextOptions=array(
                    "ssl"=>array(
                        "verify_peer"=>false,
                        "verify_peer_name"=>false,
                    ),
                );
                $result = file_get_contents($url, false, stream_context_create($arrContextOptions));
        }
        return $result;
}


//More to come :D
