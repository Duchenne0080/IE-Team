#!/bin/bash
# Author  : Duchenne
# Website : www.heartwarmer.tk used
# Run before 'chmod 777 ddos_denfence.sh'
# Run the Script every 1 minute : crontab -e ddos_denfence.sh
# */1 * * * * /root/bin/ddos_defence.sh
/bin/netstat -na | grep ESTABLISHED |awk '{print $5}' | awk -F: '{print $1}' | sort | uniq -c | sort -rn | head -10 | grep -v -E '192.168|127.0'|awk '{if ($2!=null && $1>4) {print $2}}'>/tmp/dropip

for i in $(cat /tmp/dropip)
do       
    /sbin/iptables -A INPUT -s $i -j DROP       
    echo "$i kill at date">>/var/log/ddos
done