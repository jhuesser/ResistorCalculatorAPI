<?php
		
			
			//Initalize values
			$firstcolor=$_GET['firstcolor'];
			$secondcolor=$_GET['secondcolor'];
			$thirdcolor=$_GET['thirdcolor'];
			$fourthcolor=$_GET['fourthcolor'];
			$hasFiveRings=$_GET['hasFiveRings'];
			if ($hasFiveRings == 1 ) {
				$fifthcolor=$_GET['fifthcolor'];
			
			} else {
				$fifthvalue=0;
				
				}
			$resultInText=$_GET['resultInText'];
			$DATE = date(DATE_RFC822);
			$disclaimer="The author can't guarantee that the results are right. Please check.";
			
			//check if error occured
			
			function checkIfError($hasError, $errorNmb, $errorMsg){
				
				if ($hasError == 1){
					//Set error message
					exit("Error: " . $errorNmb . " " . $errorMsg);
					
					}
				}
			
			function setFirstColorValue($color){
				//checks the first color and assign the value
				switch($color){
					case "brown":
						$colorvalue=1;
						break;
					case "red":
						$colorvalue=2;
						break;
					case "orange":
						$colorvalue=3;
						break;
					case "yellow":
						$colorvalue=4;
						break;
					case "green":
						$colorvalue=5;
						break;
					case "blue":
						$colorvalue=6;
						break;
					case "purple":
						$colorvalue=7;
						break;
					case "grey":
						$colorvalue=8;
						break;
					case "white":
						$colorvalue=9;
						break;
					default:
					//on error
						$errorMsg = "The color " . $color . " can't be a color at this position";
						$errorNmb = "101";
						$hasError = 1;
						$colorvalue=0;
					
					} 
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				return $colorvalue;
				}
			
			
			function setSecondColorValue($color) {
				//second color values are the same as first + a black option
				if ($color == "black") {
						$colorvalue=0;
					} else {
						$colorvalue = setFirstColorValue($color);
						
						}
				//on error
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				return $colorvalue;
				
				}
				
				
			function calculateMultipiler($color) {
				//Multipiler is 3rd or 4th ring, values are the same
				switch($color){
							
							case "silver":
								$colorvalue=0.01;
								break;
							case "gold":
								$colorvalue=0.1;
								break;
							case "black":
								$colorvalue=1;
								break;
							case "brown":
								$colorvalue=10;
								break;
							case "red":
								$colorvalue=100;
								break;
							case "orange":
								$colorvalue=1000;
								break;
							case "yellow":
								$colorvalue=10000;
								break;
							case "green":
								$colorvalue=100000;
								break;
							case "blue":
								$colorvalue=1000000;
								break;
							case "purple":
								$colorvalue=10000000;
								break;
							case "grey":
								$colorvalue=100000000;
								break;
							case "white":
								$colorvalue=1000000000;
								break;
							default:
							//on error
								$errorMsg = "The color " . $color . " can't be a color at this position";
								$errorNmb = "101";
								$hasError = 1;
								$colorvalue=0;
							}
					checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
					return $colorvalue;
				}
				
				
				
				
			
			function setThirdColorValue($color, $hasFiveRings) {
				//sets value for 3rd ring
				if ($hasFiveRings == 1){
					//if 5 rings == true, use same values as in second ring
					$colorvalue = setSecondColorValue($color);
					
				} elseif ($hasFiveRings == 0) {
						//else calculate the multipiler
					$colorvalue = calculateMultipiler($color);
						
				} else {
					//on error
					$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
					$errorNmb = "201";
					$hasError = 1;
					$colorvalue=0;
							
							}
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				
				return $colorvalue;
				}
				
				
			
			function setFourthColorValue($color, $hasFiveRings) {
				//if 5 rings == true this is the multipiler
				if ($hasFiveRings == 1){
					
					$colorvalue = calculateMultipiler($color);
					
			} elseif ($hasFiveRings == 0) {
					//else it's the tolerance
					switch($color){
						
						case "no-color":
							$colorvalue="+/- 20%";
							break;
						case "silver":
							$colorvalue="+/- 10%";
							break;
						case "gold":
							$colorvalue="+/- 5%";
							break;
						default:
							$errorMsg = "The color " . $color . " can't be a color at this position";
							$errorNmb = "101";
							$hasError = 1;
							$colorvalue=0;
					}
				} else{
					//on error
					$errorMsg = "The resultå could not be generated. Maybe your resultInText request is corrupt.";
					$errorNmb = "201";
					$hasError = 1;
					$colorvalue=0;
						
						}
				
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				return $colorvalue;
				
				}
				
				
				function setFifthColorValue($color){
					//tolerance of resistor with 5 rings
					switch($color) {
						
						case "brown":
							$colorvalue="+/- 1%";
							break;
						case "red":
							$colorvalue="+/- 2%";
							break;
						case "green":
							$colorvalue="+/- 0.5%";
							break;
						default:
							$errorMsg = "The color " . $color . " can't be a color at this position";
							$errorNmb = "101";
							$hasError = 1;
							$colorvalue=0;
							
						
						}
						checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
						return $colorvalue;
					
					}
				
			function caclulateResult($firstvalue, $secondvalue, $thirdvalue, $fourthvalue, $fifthvalue, $hasFiveRings, $resultInText){
				//calculates the result and formats the output.
				if ($hasFiveRings == 1 ){
					//for a 5 ring resistor
					//put the number together
					$numberToMultiply = $firstvalue . $secondvalue . $thirdvalue;
					//multiply that number with the multipiler, this is the ohm value
					$ohm = $numberToMultiply * $fourthvalue;
					//tolerance is the 5th ring
					$tolerance = $fifthvalue;
					
					if ($resultInText == 1 ){
						//if user wants the result as text, set up the text
						$RESULT="Your resistor has " . $ohm . " Ohm. The tolerance is " . $tolerance . ".";
						
						} elseif ($resultInText == 0) {
							//if user wants json, put a string with : as delmiter togheter.
							$RESULT=$ohm . ":" . $tolerance;
							
							} else {
								//on error
								$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
								$errorNmb = "201";
								$hasError = 1;
								$colorvalue=0;
								
								}
					
					} elseif ($hasFiveRings == 0){
						//for resistor with 4 rings
						//put the number together
						$numberToMultiply = $firstvalue . $secondvalue;
						//multiply that number with the multipiler, this is the ohm value
						$ohm = $numberToMultiply * $thirdvalue;
						//tolerance is the 4th ring
						$tolerance = $fourthvalue;
						
						
						if ($resultInText == 1 ){
							//if user wants the result as text, set up the text
						$RESULT="Your resistor has " . $ohm . " Ohm. The tolerance is " . $tolerance . ".";
						
						} elseif ($resultInText == 0) {
							//if user wants json, put a string with : as delmiter togheter.
							$RESULT=$ohm . ":" . $tolerance;
							
							} else {
								//on error
								$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
								$errorNmb = "201";
								$hasError = 1;
								$colorvalue=0;
								
								}
						
						} else {
							//on error
							$errorMsg = "The result could not be calculated. Maybe your hasFiveRings request is corrupt.";
							$errorNmb = "202";
							$hasError = 1;
							$colorvalue=0;
							
							
							
							}
							checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
						
				
				return $RESULT;
				
				}
/*

	THE SCRIPT STARTS HERE
	HERE TO FUNCTIONS ABOVE ARE GETTING CALLED




*/				

				//this block is needed to avoid errors
				$hasError=0;
				$errorNmb=0;
				$errorMsg=0;
				
				
				//calling the functions to get the values of the colors
				$firstvalue=setFirstColorValue($firstcolor);
				
				$secondvalue=setSecondColorValue($secondcolor);
				
				$thirdvalue=setThirdColorValue($thirdcolor, $hasFiveRings);
				
				$fourthvalue=setFourthColorValue($fourthcolor, $hasFiveRings);
				
				if ($hasFiveRings == 1){
					$fifthvalue=setFifthColorValue($fifthcolor);
					
				} elseif ($hasFiveRings == 0){
					//to avoid calculating error
					$fithvalue=0;
					
					} else {
						//on error
						$errorMsg = "The result could not be calculated. Maybe your hasFiveRings request is corrupt.";
						$errorNmb = "202";
						$hasError = 1;
						$colorvalue=0;	
						
						}
						
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				//calculate the result
				$RESULT = caclulateResult($firstvalue, $secondvalue, $thirdvalue, $fourthvalue, $fifthvalue, $hasFiveRings, $resultInText);
				checkIfError($GLOBALS['hasError'], $GLOBALS['errorNmb'], $GLOBALS['errorMsg']);
				
				
				//echo the result
				if ($resultInText == 0){
				//if user wants json
				//cut the result at delmiter ":"
				$cutResult = explode(":", $RESULT);
				//write the json array
				$result_json = array('ohm' => $cutResult[0], 'tolerance' => $cutResult[1], 'disclaimer' => $disclaimer);
				//write the headers
				header('Cache-Contoil: no-cache, must-revalidate');
				header('Expires: ' . $DATE);
				
				
				header('Content-type: application/json');
				//echo json
				echo json_encode($result_json);
				
				} else {
					//echo text
					echo $RESULT . " " . $disclaimer;
					
					}
			
		?>
