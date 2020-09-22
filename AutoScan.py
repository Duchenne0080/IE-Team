import re

import gzip

import os

badrequest=['Firefox/62.0']

def scan_apache_gzip_log(filename):

    iplist=set()

    f=gzip.open(filename,'r')

    for eachline in f:

        eachline=eachline.decode('utf-8')

        s=re.finditer('^\d+\.\d+\.\d+\.\d+',eachline)

        for s in s:

            ip=s.group()

        for item in badrequest:                             

            if(eachline.find(item)>0):

                iplist.add(ip)

    f.close()

    return iplist

def scan_apache_log(filename):                    

    iplist=set()

    f=open(filename,'r')

    for eachline in f:

        s=re.finditer('^\d+\.\d+\.\d+\.\d+',eachline)

        for s in s:

            ip=s.group()

        for item in badrequest:

            if(eachline.find(item)>0):

                iplist.add(ip)

    f.close()

    return iplist

def insert_into_ipset(iplist):

    if(len(iplist)>0):

        for item in iplist:

            os.system('/sbin/ipset add banlist '+item)

if __name__=='__main__':

    apachelog="/var/log/apache2/access.log" 

    iplist=scan_apache_log(apachelog)

    insert_into_ipset(iplist)