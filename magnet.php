<!DOCTYPE html>
<html>
<body>

<a href="http://192.168.2.12:8112">Deluge WebGUI</a>
<br>
<?php
$storage_file = "/home/pi/magnets";

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
                $fp = fopen($storage_file, "a") or die ("Couldn't open torrent storage file.");
                fputs($fp,$url."\n");
                fputs($fp,$name."\n");
                fclose ($fp);
                echo "<a href=".$url.">".$name."</a><br>";
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


