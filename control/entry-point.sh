#!/bin/bash

# Copy all environment variables to file /etc/environment to make them visibile to cron
env >> /etc/environment
echo $(date) Starting control unit.>>/var/control/system.log 2>&1
python3 /scripts/api.py &
cron -f
