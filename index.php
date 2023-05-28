<?php

if (isset($_POST['submit_btn'])) {
	
	// Storing name in $name variable
	$name = $_POST['name'];
	
	// Storing google recaptcha response
	// in $recaptcha variable
	$recaptcha = $_POST['h-captcha-response'];
	// Put secret key here, which we get
	// from google console
	$secret_key = '';
	// Hitting request to the URL, Google will
	// respond with success or error scenario
	$url = 'https://hcaptcha.com/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
	// Making request to verify captcha
	$response = file_get_contents($url);
	// Response return by google is in
	// JSON format, so we have to parse
	// that json
	$response = json_decode($response);
	// Checking, if response is true or not
	if ($response->success == true) {	
		if ($_POST["likedevysmodels"] == "Ne"){
			die("This service doesnt support cheating.");
		}
		else{
			$url = $_POST["discorduser"];
			$starttime = time();
			$response = file_get_contents($url);
			$source_code = $response;

			$dom = new DOMDocument();
			libxml_use_internal_errors(true);
			$dom->loadHTML($source_code);
			libxml_clear_errors();

			$scriptTags = $dom->getElementsByTagName('script');
			$pattern = "/https:\/\/docs\.google\.com\/spreadsheets\/d\/([A-Za-z0-9_-]+)\/pubhtml/";
			$matches = [];

			foreach ($scriptTags as $scriptTag) {
			    $scriptContent = $scriptTag->textContent;
			    if (preg_match($pattern, $scriptContent, $match)) {
			        $matches[] = $match[1];
			    }
			}

			if (!empty($matches)) {
			    $spreadsheet_id = $matches[0];
			
			    $spreadsheet_url = "https://docs.google.com/spreadsheets/d/{$spreadsheet_id}/pubhtml";
			    $response = file_get_contents($spreadsheet_url);
			    $link = $spreadsheet_url;
			    $normalized_link = str_replace(array("(", ")", "'", ",", "/pubhtml"), "", $link);
			    $normalized_link .= "/pubhtml";
			    echo "I would like to inform you that shared answers must not be used for any purposes related to school. This information is provided solely as general advice and information and should not be used for cheating, rule-breaking, or any other dishonest or unethical practices in relation to school responsibilities. It is important to adhere to the rules and ethical standards set by your school and to carry out your tasks independently.\n<br><br>";
			    $end = abs($starttime - time());
			    echo '<font color="green">Here are the answers</font>: ' . str_replace(" ", "", $normalized_link);
				die;
			} else {
			    echo '<font color="red">No matching URL found.</font>';
			}
		}
	}
 	else {
		die("Recaptcha Failed!");
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="title" content="Flippity Bypass">
<meta name="description" content="Made by Take">
          <body style="background-color:#202324;">
	<!----<link rel="stylesheet" href="style.css">---->


</head>
<link rel="stylesheet" href="style.css">
<body style="background-color:#202324;">
<body>
<center><h1><font color="white"><div class="textversion">Flippity Bypass 1.0 - Web</div></font></h1></center>
<div class="container">
<form action="index.php" method="post">
<h3><font color="white">Flippity.net link</font></h3>
<input type="text" name="discorduser" id="discorduser"><bf>
<h3><font color="white">You agree that you wont cheat with the results?</font></h3>
<input type="radio" name="likedevysmodels" id="likedevysmodels" value="Ne" /> No
<input type="radio" name="likedevysmodels" id="likedevysmodels" value="Ano" /> Yes<br><br>
<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
<div class="h-captcha" data-sitekey="" data-theme="dark"></div>
<button type="submit" name="submit_btn">
				Submit
			</button>
		</form>
</div>
<br><b>Source code: <a href="https://github.com/takoda121/Flippity-Bypass">Github</a></b>
</body>

</html>
