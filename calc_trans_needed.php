<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<form name='input' action="calc_trans_needed.php" method="post">
<input type="textbox" name="savefile">
<input type="submit" value="submit">
</form>
<?php
include "functions.php";
include "ancient_calculator.php";
include "global_utils.php";

$u_savefile=get_POSTValue("savefile");

if( ! $u_savefile )
{
	print "</body></html>";
	die;
}

//The regex "'/(.)./','$1'" says "remove every other character.
//So the string 1a2b3c would become 123
//$json = json_decode(base64_decode(preg_replace('/(.)./','$1',preg_split("/$ANTI_CHEAT_CODE/",$input)[0])));
$json = json_decode(base64_decode(preg_replace('/(.)./','$1',preg_split("/$ANTI_CHEAT_CODE/",$u_savefile[0])[0])));

#Debug commands
print("<pre>");

computeNextAncients($json);

print("</pre>");

?>
</body>
</html>
