flexget-deluge-magnet-injector
==============================

Tiny project that allows manual injection of movie magnet links through a web ui into flexget and deluge.
Project consists of a python daemon (magnet.py) that listens for magnet link requests, translates them to torrent files through torrage.com, and injects them into flexget. Flexget uses the config.yml to make deluge download the torrent to a predefined position.
A php page is also included, that pushes the magnet links into the daemon. This was made to facilitate me to download movie torrents to my headless Raspberry Pi, without using the console and with flexget automatically setting a tidy download position.

Installation/Running:
config.yml should go to the same position where the magnet.py configpos variable points.
magnet.py should be running.
magnet.php should go to your webservers public html folder.
