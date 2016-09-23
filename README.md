# Working status

- Syntax is valiaded.
- Calculation works.
- Error Handling doesnt work. (See [#1](https://github.com/jhuesser/ResistorCalculatorAPI/issues/1)).




# ResistorCalculatorAPI
This is an API to calculate the ohm value of resistors with the color code given. You can POST values to this API which makes the calculations. So you can built your own solutions, but don't need to worry about the calculation.

# FAQ

## Do I need to colone the repo, to make my solution running?
No. If you just want to create a solution, just make your API calls with HTTP POST to ```https://api.jhuesser.ch/rescalcapi.php```

## What does the result looks like?
You will get a header and a body. In the body the result is between the <RESULT></RESULT> tags. If you have a better soloution just let me know.

## What about translations?
Your solotion can have any language! Just the HTTP POST values need to be english color names, but in your UI you can show it however you want. The result is between to tags (see above) and contains only the numbers you need. There is an standard prompt in english if you set ```resultInText``` to ```1``` .

# Parameters List
Here is a list of Parameters. At the end is an example for a API call.

Name | Description | requiered
-----|-------------|----------
```firstcolor``` | The 1st color | yes
```secondcolor``` | The 2nd color | yes
```thirdcolor``` | The 3rd color | yes
```fourthcolor``` | The 4th color | yes
```fifthcolor``` | The 5th color | depends on ```hasFiveRings```
```hasFiveRings``` | Set to ```1``` if the resistor has 5 rings  | no
```resultInText``` | Set to ```1``` if you want the standard english output | yes

## Example call:
```https://api.jhuesser.ch/rescalcapi.php?firstcolor=red&secondcolor=orange&thirdcolor=yellow&fourthcolor=silver&hasFiveRings=0&resultInText=0```

## Result from above:
```html
<!doctype html>
	<html>
		<head>
			<meta charset="utf-8">
				<title>Resistor Calculator API</title>
			</head>
			<body>
				<RESULT>230000:+/- 10%</RESULT>
			</body>
		</html>
```
# Error Codes

## Quick overview

If the Error handling is working in the future, this is an overview for the error codes.

- 1xx User error. The user made a request, which resulted in an error. this mostly happens in your solution.
- 2xx Developer error. This often happens when you made an error. Mostly a parameter is corrupt in your request (or even missing)
- 3xx API error. An error that happens server side. currently not implemented.	

## User errors

Error number | Error message | Descriptoon
-------------|---------------|------------
101 | The color " . $color . " can't be a color at this position | The API compares the color you give it with a switch case. If the switch fails, this is the error. So your color is invalid, or the color can't be at this position. It will prompt you the color in question.


## Developer errors

Error number | Error message | Descriptoon
-------------|---------------|------------
201 | The result could not be generated. Maybe your resultInText request is corrupt. | This error shows up, if the API tests which value ```resultInText``` has. If it's not ```0``` or ```1``` this happens.
202 | The result could not be calculated. Maybe your hasFiveRings request is corrupt. | If the API checks if the ```hasFiveRings``` value is ```0``` or ```1``` and it's neither of both, this error will show up.


## API errors
Currently not implemented. will take a look if the error handeling works.

Error number | Error message | Descriptoon
-------------|---------------|------------
