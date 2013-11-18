#!/usr/bin/env python

import time
import thread
import sys
import socket
import Queue
from subprocess import call
from urllib import unquote
 
q = Queue.Queue()
configpos = "/home/pi/.flexget/config.yml";

def isSeries(str):
	return (len(str) == 6 and str[0:1].upper() == "S" and str[1:3].isdigit() and str[3:4].upper() == "E" and str[5:].isdigit()) 

def magnetParse((link,task)):
	if task == "":
		print "No flag specified (-m for movies, -s for series)"
		return
	vars = link.split("?")[1].split("&")
	for var in vars:
		if var.startswith("xt="):
			hash = var.split("btih:")[1]
		elif var.startswith("dn="):
			name = unquote(var[3:]).replace("+"," ")
	url = "http://torrage.com/torrent/"+hash.upper()
	print "Downloading %s from %s" % (name,url)
	return call(["flexget","-c",configpos,"--task="+task,"--inject",name,url,"yes","yes"])

def consumer():
	while True:
		if q.empty():
			time.sleep(1)
		else:
			link = q.get()
			if magnetParse(link) != 0:
				q.put(link)				
		

thread.start_new_thread( consumer, () )

serversocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
serversocket.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
serversocket.bind(('localhost', 8110))
serversocket.listen(5)
print "Magnet link downloader listening on localhost:8110"
while True:
	try:
		connection, client_address = serversocket.accept()
		t = connection.recv(1)
		if t == "m":
			t = "moviesDL"
		elif t == "s":
			t = "seriesDL"
		else:
			raise Exception("Invalid type")
		mlen = int(connection.recv(3))
		if mlen == 0:
			raise Exception("Invalid link length:"+str(mlen))			
		magn = connection.recv(mlen)
		print "Received %s link of len %d" %(t,mlen)
		q.put((magn,t))
	except Exception as exc:
		print exc
	finally:
		connection.close()
