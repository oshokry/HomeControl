from gpiozero import OutputDevice
from time import sleep
from datetime import datetime
from util import getSolenoidPins
from util import getIrrigationDB

def saveToWaterHistory(ts, sNumber, mode, t):
  db = getIrrigationDB()
  cur = db.cursor()
  pressure = 0
  sql = """INSERT INTO WaterHistory (timestamp, solenoidNumber, mode, lengthSeconds) VALUES (%s, %s, %s, %s)"""
  data = (ts, sNumber, mode, t)
  try:
    cur.execute(sql, data)
    db.commit()
    cur.close()
  except:
    db.rollback()
    print(str(datetime.now()) + " Saving WaterHistory to DB failed")

def doIrrigate(mode, sNumber, t):
  ts = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
  pins = getSolenoidPins()
  i = int(sNumber) - 1
  S = OutputDevice(pins[i])
  print(str(datetime.now()) + " BEGIN irrigate " + str(sNumber) + ", " + mode + " mode.")
  S.on()
  print(str(datetime.now()) + " Solenoid " + str(sNumber) + " opened. Irrigate for " + str(t) + " seconds.")
  sleep(t)
  S.off()
  print(str(datetime.now()) + " Solenoid " + str(sNumber) + " closed.")
  print(str(datetime.now()) + " END irrigate " + str(sNumber) + ", " + mode + " mode.\n")
  saveToWaterHistory(ts, sNumber, mode, t)

def closeAll():
  pins = getSolenoidPins()
  for pin in pins:
    S = OutputDevice(pin)
    S.off
