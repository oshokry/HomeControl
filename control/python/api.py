from flask import Flask, request
from os import system
from util import getLogPath, getScriptsPath

app = Flask(__name__)

def getIrrigationLogFile():
  return getLogPath() + 'irrigation.log 2>&1 &'
  
@app.route('/irrigate', methods=['GET', 'POST'])
def callIrrigate():
  query_parameters = request.args
  solenoid = query_parameters.get('solenoid')
  duration = query_parameters.get('duration')
  command = 'python3 ' + getScriptsPath() + 'irrigate.py '

  if solenoid and duration:
    command += solenoid
    command += ' '
    command += duration
    command += ' web >> ' + getIrrigationLogFile()
    system(command)
  
  return command
  
@app.route('/closeall', methods=['GET', 'POST'])
def callCloseAll():
  command = 'python3 ' + getScriptsPath() + 'closeall.py web >> ' + getIrrigationLogFile()
  system(command)
  return command

if __name__ == '__main__':
  app.run(debug=True, host='0.0.0.0')
