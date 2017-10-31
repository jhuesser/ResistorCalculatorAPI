# Working status

- Syntax is validated.
- Calculation works.
- Error Handling doesnt work. (See [#1](https://github.com/jhuesser/ResistorCalculatorAPI/issues/1)).

[![Code Climate](https://codeclimate.com/github/jhuesser/ResistorCalculatorAPI/badges/gpa.svg)](https://codeclimate.com/github/jhuesser/ResistorCalculatorAPI)
[![Issue Count](https://codeclimate.com/github/jhuesser/ResistorCalculatorAPI/badges/issue_count.svg)](https://codeclimate.com/github/jhuesser/ResistorCalculatorAPI)



# ResistorCalculatorAPI
This is an API to calculate the ohm value of resistors with the color code given. You can POST values to this API which makes the calculations. So you can built your own solutions, but don't need to worry about the calculation.

# FAQ

## Do I need to clone the repo, to make my solution running?
No. If you just want to create a solution, just make your API calls with HTTP POST to ```https://api.widerstandsberechner.ch/api.php```

## What does the result looks like?
If you set ```resultInText```to ```0```, you will receive the result in json. If you set it to ```1``` You receive the standard answer as plain text.

This
```
https://api.widerstandsberechner.ch/api.php?firstcolor=red&secondcolor=orange&thirdcolor=yellow&fourthcolor=silver&hasFiveRings=0&resultInText=0
```
results in this:

```json
{
  "ohm": "230000",
  "tolerance": "+/- 10%"
}

```
 and this:
 ```
 https://api.widerstandsberechner.ch/api.php?firstcolor=red&secondcolor=orange&thirdcolor=yellow&fourthcolor=silver&hasFiveRings=0&resultInText=1
 
```

in this:

```html
Your resistor has 230000 Ohm. The tolerance is +/- 10%.
```
 
## What about translations?
Your solotion can have any language! Just the HTTP POST values need to be english color names, but in your UI you can show it however you want. The result is between to tags (see above) and contains only the numbers you need. There is an standard prompt in english if you set ```resultInText``` to ```1``` .

# Parameters List
Here is a list of Parameters. At the end is an example for a API call.

Name | Description | required
-----|-------------|----------
```firstcolor``` | The 1st color | yes
```secondcolor``` | The 2nd color | yes
```thirdcolor``` | The 3rd color | yes
```fourthcolor``` | The 4th color | yes
```fifthcolor``` | The 5th color | depends on ```hasFiveRings```
```hasFiveRings``` | Set to ```1``` if the resistor has 5 rings  | no
```resultInText``` | Set to ```1``` if you want the standard english output | yes

## accepted values:

- no-color
- silver
- gold
- black
- brown
- rot
- orange
- yellow
- green
- blue
- purple
- grey
- white

## Example call:
```
https://api.widerstandsberechner.ch/api.php?firstcolor=red&secondcolor=orange&thirdcolor=yellow&fourthcolor=silver&hasFiveRings=0&resultInText=0
```

## Result from above:
```json
{
  "ohm": "230000",
  "tolerance": "+/- 10%"
}

```
# Error Codes

## Quick overview

If the Error handling is working in the future, this is an overview for the error codes.

- 1xx User error. The user made a request, which resulted in an error. this mostly happens in your solution.
- 2xx Developer error. This often happens when you made an error. Mostly a parameter is corrupt in your request (or even missing)
- 3xx API error. An error that happens server side. currently not implemented.	

## User errors

Error number | Error message | Description
-------------|---------------|------------
101 | The color " . $color . " can't be a color at this position | The API compares the color you give it with a switch case. If the switch fails, this is the error. So your color is invalid, or the color can't be at this position. It will prompt you the color in question.


## Developer errors

Error number | Error message | Description
-------------|---------------|------------
201 | The result could not be generated. Maybe your resultInText request is corrupt. | This error shows up, if the API tests which value ```resultInText``` has. If it's not ```0``` or ```1``` this happens.
202 | The result could not be calculated. Maybe your hasFiveRings request is corrupt. | If the API checks if the ```hasFiveRings``` value is ```0``` or ```1``` and it's neither of both, this error will show up.


## API errors
Currently not implemented. will take a look if the error handling works.

Error number | Error message | Description
-------------|---------------|------------
