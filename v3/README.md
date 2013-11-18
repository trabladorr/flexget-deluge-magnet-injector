flexget-deluge-magnet-injector
==============================

Tiny project that allows manual downloading of movie magnet links through a web ui into flexget and deluge.
Project consists of a php page (magnet.php) that accepts magnet link requests, translates them to torrent file links through torrage.com, and saves them along with the movie information in a temporary file.
A second php page, feed.php, converts the saved information into an rss feed, which flexget uses to make deluge download the torrent to a predefined position.
This was made to facilitate me to download movie torrents to my headless Raspberry Pi, without using the console and with flexget automatically setting a tidy download position.

Installation:
config.yml should go wherever flexget looks for it.
magnet.php, feed.php should go to your webservers public html folder.

Using:
Access magnet.php through a browser, and paste one or more movie magnet links into the textarea. Depending on your flexget/crontab configuration, the movies will be downloaded to a tidy location.
