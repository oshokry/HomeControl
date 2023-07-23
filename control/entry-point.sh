#!/bin/bash
echo $(date) Starting control unit.>>/var/control/system.log 2>&1
python3 /scripts/api.py &
cron -f
