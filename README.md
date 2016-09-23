# Working status

- Syntax is valiaded.
- Calculation works.
- Error Handling doesnt work. (See #1).




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
