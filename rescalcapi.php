<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Resistor Calculator API</title>
	
	
	</head>
	<body>
		<?php
			
			//Initalize values
			$firstcolor=$_POST['firstcolor'];
			$secondcolor=$_POST['secondcolor'];
			$thirdcolor=$_POST['thirdcolor'];
			$fourthcolor=$_POST['fourthcolor'];
			$hasFiveRings=$_POST['hasFiveRings'];
			if ($hasFiveRings == 1 ) {
				$fifthcolor=$_POST['fithcolor'];
			
			}
			$resultInText=$_POST['resultInText'];
			
			
			//check if error occured
			
			function checkIfError($hasError){
				
				if ($hasError == 1){
					exit("Error: " . $errorNmb . " " . $errorMsg);
					
					}
				}
			
			function setFirstColorValue($color){
				
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
					case "violett":
						$colorvalue=7;
						break;
					case "grey":
						$colorvalue=8;
						break;
					case "white":
						$colorvalue=9;
						break;
					default:
						$errorMsg = "The color " . $color . " can't be a color at this position";
						$errorNmb = "101";
						$hasError = 1;
					
					} 
				
				return $colorvalue;
				}
			
			
			function setSecondColorValue($color) {
				
				if ($color == "black") {
						$colorvalue=0;
					} else {
						$colorvalue = setFirstColorValue($color);
						
						}
				
				
				return $colorvalue;
				}
				
				
			function calculateMultipiler($color) {
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
							case "violett":
								$colorvalue=10000000;
								break;
							case "grey":
								$colorvalue=100000000;
								break;
							case "white":
								$colorvalue=1000000000;
								break;
							default:
								$errorMsg = "The color " . $color . " can't be a color at this position";
								$errorNmb = "101";
								$hasError = 1;
							
							}
				
					return $colorvalue;
				}
				
				
				
				
			
			function setThirdColorValue($color) {
				
				if ($hasFiveRings == 1){
					
					$colorvalue = setSecondColorValue($color);
					
				} elseif ($hasFiveRings == 0) {
						
					$colorvalue = calculateMultipiler($color);
						
				} else {
					$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
					$errorNmb = "201";
					$hasError = 1;
							
							}
				
				
				return $colorvalue;
				}
				
				
			
			function setFourthColorValue($color) {
				
				if ($hasFiveRings == 1){
					
					$colorvalue = calculateMultipiler($color);
					
			} elseif ($hasFiveRings == 0) {
						
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
					}
				} else{
					$errorMsg = "The resultå could not be generated. Maybe your resultInText request is corrupt.";
					$errorNmb = "201";
					$hasError = 1;
						
						}
				
				
				return $colorvalue;
				
				}
				
				
				function setFifthColorValue($color){
					
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
							
						
						}
						
						return $colorvalue;
					
					}
				
			function caclulateResult($firstvalue, $secondvalue, $thirdvalue, $fourthvalue, $fifthvalue){
				
				if ($hasFiveRings == 1 ){
					
					$numberToMultiply = $firstvalue . $secondvalue . $thirdvalue;
					$ohm = $numberToMultiply * $fourthvalue;
					$tolerance = $fifthvalue;
					
					if ($resultInText == 1 ){
						$RESULT="Your resistor has " . $ohm . " Ohm. The tolerance is " . $tolerance . ".";
						
						} elseif ($resultInText == 0) {
							$RESULT=$ohm . ":" . $tolerance;
							
							} else {
								$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
								$errorNmb = "201";
								$hasError = 1;
								
								}
					
					} elseif ($hasFiveRings == 0){
						$numberToMultiply = $firstvalue . $secondvalue;
						$ohm = $numberToMultiply * $thirdvalue;
						$tolerance = $fourthvalue;
						
						
						if ($resultInText == 1 ){
						$RESULT="Your resistor has " . $ohm . " Ohm. The tolerance is " . $tolerance . ".";
						
						} elseif ($resultInText == 0) {
							$RESULT=$ohm . ":" . $tolerance;
							
							} else {
								$errorMsg = "The result could not be generated. Maybe your resultInText request is corrupt.";
								$errorNmb = "201";
								$hasError = 1;
								
								}
						
						} else {
							$errorMsg = "The result could not be calculated. Maybe your hasFiveRings request is corrupt.";
							$errorNmb = "202";
							$hasError = 1;
							
							
							
							}
						
				
				return $RESULT;
				
				}
				checkIfError($hasError);
				$firstvalue=setFirstColorValue($firstcolor);
				checkIfError($hasError);
				$secondvalue=setSecondColorValue($secondcolor);
				checkIfError($hasError);
				$thirdvalue=setThirdColorValue($thirdcolor);
				checkIfError($hasError);
				$fourthvalue=setFourthColorValue($fourthcolor);
				checkIfError($hasError);
				if ($hasFiveRings == 1){
					$fifthvalue=setFifthColorValue($fifthcolor);
					checkIfError($hasError);
				} elseif ($hasFiveRings == 0){
					$fithvalue=0;
					checkIfError($hasError);
					} else {
						$errorMsg = "The result could not be calculated. Maybe your hasFiveRings request is corrupt.";
						$errorNmb = "202";
						$hasError = 1;	
						
						}
				checkIfError($hasError);
				$RESULT = caclulateResult($firstvalue, $secondvalue, $thirdvalue, $fourthvalue, $fifthvalue);
				checkIfError($hasError);
				echo $RESULT;
			
		?>
	</body>
</html>