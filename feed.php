<?php
  $storage_file = "/home/pi/magnets";
  
  header("Content-Type: text/xml; UTF-8");
  echo '<?xml version="1.0" encoding="UTF-8"?>';
  echo '<rss version="2.0">';
  echo '<channel>';
  echo '<title>RSS Feed generated from magnets</title>';
  echo '<link>http://127.0.0.1</link>';
  echo '<ttl>30</ttl>';
  echo '<description>None</description>';

  $fp = fopen($storage_file,"r");
  while(!feof($fp)){
    $url = trim(fgets($fp));
    $name = trim(fgets($fp));
    if (strlen($url) === 0)
            break;
    $url .= '.torrent';
    echo '<item>';
    echo '<title>'.$name.'</title>';
    echo '<link>'.$url.'</link>';
    echo '<guid isPermaLink="true">'.$url.'</guid>';
    echo '<enclosure url="'.$url.'" length="0" type="application/x-bittorrent" />';
    echo '</item>';
  }
  fclose($fp);

  echo '</channel>';
  echo '</rss>';
?>
