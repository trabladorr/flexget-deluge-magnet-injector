
<!DOCTYPE html>
<html>

<?php
$ip = "192.168.2.12";
$deluge_port = "8112";
$storage_file = "/home/pi/magnets";
$flexget_config = "/home/pi/.flexget/config.yml";

echo "<a href=\"http://".$ip.":".$deluge_port."\">Deluge WebGUI</a>"
?>

<body>
<br>

<?php
if (isset($_POST["links"]) && !empty($_POST["links"])) {
	echo "<br>Adding to Download feed:<br>";
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $_POST["links"]) as $line){
                $id += 1;
                //parse magnet url
                $vars = explode("&",explode("?", $line)[1]);
                foreach($vars as $var){
                        if (strpos($var, "xt=") === 0)
                                $hash = substr($var,12);
                        elseif (strpos($var, "dn=") === 0)
                                $name = urldecode(substr($var,3));
                }

                $url = "http://torrage.com/torrent/".strtoupper($hash);

                //open torrent info file, and save location and name data
                $fp = fopen($storage_file, "w") or die ("Couldn't open torrent storage file.");
		fputs($fp,$url."\n");
		fputs($fp,$name."\n");
                fclose ($fp);
                echo "<a href=".$url.">".$name."</a><br>";

                //run flexget in background
		system("sudo /usr/local/bin/flexget -c ".$flexget_config." --cron --task moviesDL > /dev/null 2>&1 &");

		//echo "<pre>";
		//passthru("sudo /usr/local/bin/flexget -c /home/pi/.flexget/config.yml --task moviesDL 2>&1");
		//echo "</pre>";
        }
}
?>
<br>
Paste magnet links in the textarea below:<br>
<form action="index.php" method="post">
<textarea name="links" rows="10" cols="200">
</textarea>
<br>
<input type="submit" name="submit" value="Download">
</form>

</body>
</html>

