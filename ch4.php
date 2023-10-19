<?php

//Example 4-1 - boolean
echo "a: [". (20 > 9) . "]<br>";
echo "b: [". (5 == 6) . "]<br>";
echo "c: [". (1 == 0) . "]<br>";
echo "d: [". (1 == 1) . "]<br>";

//Example 4-3 - literals/variables
//declare variables
$myname = "Brian";
$myage = 37;
//echo literals/variables
echo "a: ". 73 . "<br>"; //numeric literal
echo "b: ". "Hello" . "<br>"; //string literal
echo "c: ". FALSE . "<br>"; //constant literal
echo "d: ". $myname . "<br>"; //string variable
echo "e: ". $myage . "<br>"; //numeric variable

//Example 4-11 
$level = $score = $time = 0; //right to left

//Example 4-12 
$month = "March";
if ($month == "March"){
	echo "It's springtime<br>";
	}

//Example 4-15
$a = 2; $b = 3; 

if($a > $b) echo "$a is greater than $b<br>";
if($a < $b) echo "$a is less than $b<br>";
if($a >= $b) echo "$a is greater than or equal to $b<br>";
if($a <= $b) echo "$a is less than or equal to $b<br>";


//Logicals
//AND - if both are true
//OR - if either one is true or both are true
//XOR - if either one is true
//NOT 

//Example 4-16
$a = 1; 
$b =0;  

echo ($a AND $b) . " A <br>";
echo ($a OR $b). " B <br>"; //either can be true for result to be true or both can be true
echo ($a XOR $b) . " C <br>"; //if both are true, then will be false; only one of them can be true
echo (!$a) . " D <br>"; //! is code for NOT

//Conditionals
//Example 4-19
$bank_balance = 50;
$money = 0;
if($bank_balance < 100){
	$money = 1000;
	$bank_balance += $money;
}
echo $bank_balance.'<br>';

//ELSE
//Example 4-20
$bank_balance = 101;
$money = 0;
$savings = 25;
if($bank_balance < 100){
	$money = 1000;
	$bank_balance += $money;
}else{
	$savings += 50;
	$bank_balance -= 50;
}
echo $bank_balance.'<br>';

//ELSEIF
//Example 4-21
$bank_balance = 201;
$money = 0;
$savings = 25;

if($bank_balance < 100)
{
	$money = 1000;
	$bank_balance += $money;
}
elseif($bank_balance > 200)
{
	$savings += 100;
	$bank_balance -= 100;
}
else 
{
	$savings += 50;
	$bank_balance -= 50;
}
echo $bank_balance . "<br>";


//Switch
//Example 4-23
$page = "About"; 
switch ($page)
{
	case "Home":
		echo "You selected Home<br>";
		break; //"break" breaks out of that particular statement
	case "About":
		echo "You selected About<br>";
		break;
	case "News":
		echo "You selected News<br>";
		break;
	case "Login":
		echo "You selected Login<br>";
		break;
	case "Links":
		echo "You selected Links<br>";
		break;
}


//Ternary
//Example 4-26
$fuel = 1;
echo ($fuel <= 1) ? "Fill tank now<br>" : "There's enough fuel<br>";


//Looping
//Example 4-28 - While Loop
$fuel =10;
while($fuel > 1)
{
	//keep driving
	echo "There's enough fuel" . "<br>";
	--$fuel;
}

//Example 4-32 Do While
$count = 1;

do {
	echo "$count times 12 is " . $count * 12;
	echo "<br>";	
} while ( ++$count <= 12 );

//Example 4-34 For Loop
for ($count = 0; $count <= 12; ++$count)
{
	echo "$count times 12 is " . $count * 12;
	echo "<br>";
}

///xys yes

?>