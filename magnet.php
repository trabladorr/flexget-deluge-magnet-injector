<?php
if (isset($_POST["links"]) && !empty($_POST["links"])) {
	echo "Downloading:<br>";
	$id = 0;
	foreach(preg_split("/((\r?\n)|(\r\n?))/", $_POST["links"]) as $line){
		$id += 1;
		$host="127.0.0.1";
		$port = 8110;
		$fp = fsockopen ($host, $port, $errno, $errstr);
		if (!$fp){
			echo "Error: could not open socket connection<br>";
		}
		else{
			fputs ($fp, "m");
			fputs ($fp, sprintf('%03d', strlen($line)));
			fputs ($fp, $line);
			fclose ($fp);
			echo "<a href=".$line.">magnet".$id."</a><br>";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<body>

<a href="http://192.168.2.12:8112">Deluge WebGUI</a>
<br>
<br>
Paste magnet links in the textarea below<br>
<form action="index.php" method="post">
<textarea name="links" rows="10" cols="200">
</textarea>
<br>
<input type="submit" name="submit" value="Download">
</form>

</body>
</html>

