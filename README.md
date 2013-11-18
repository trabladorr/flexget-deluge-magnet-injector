flexget-deluge-magnet-injector
==============================

Tiny project that allows manual downloading of movie magnet links through a web ui into flexget and deluge.
Project consists of a php page (magnet.php) that accepts magnet link requests, translates them to torrent file links through torrage.com, and saves them along with the movie information in a temporary file.
Magnet php will also attempt to run flexget in the background, which requires write access for user www-data to the .flexget folder.
A second php page, feed.php, converts the saved information into an rss feed, which flexget uses to make deluge download the torrent to a predefined position.
This was made to facilitate me to download movie torrents to my headless Raspberry Pi, without using the console and with flexget automatically setting a tidy download position.

Installation:
config.yml should go wherever flexget looks for it, change ****** for proper usernames and passwords
magnet.php, feed.php should go to your webservers public html folder, change variables to corresponding ones on your system
sudoers access for user www-data to flexget may be required (sudo visudo, add: "www-data ALL= NOPASSWD: /usr/local/bin/flexget" to the end without quotes)


Using:
Access magnet.php through a browser, and paste one or more movie magnet links into the textarea. Depending on your flexget/crontab configuration, the movies will be downloaded to a tidy location.
