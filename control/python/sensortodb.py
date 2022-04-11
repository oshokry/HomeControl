# Based on code from freenove
from Freenove_DHT import DHT
from datetime import datetime
from time import strftime
from util import getIrrigationDB, getDHT11Pin
from sys import argv

def saveToDB(humidity, temperature):
  print(str(datetime.now()) + " Humidity : %.2f, \t Temperature : %.2f \n"%(humidity, temperature))
  db = getIrrigationDB()
  cur = db.cursor()
  ts = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
  pressure = 0
  sql = """INSERT INTO sensor (timestamp,temperature,pressure,humidity) VALUES (%s,%s,%s,%s)"""
  data = (ts, temperature, pressure, humidity)
  try:
    cur.execute(sql, data)
    db.commit()
  except:
    db.rollback()
    print(str(datetime.now()) + " Saving Sensor data to DB failed")

if __name__ == '__main__':
  DHTPin = getDHT11Pin()
  if len(argv) == 2:
    DHTPin = int(argv[1])
  dht = DHT(DHTPin)
  chk = dht.readDHT11()
  if (chk is dht.DHTLIB_OK):
    saveToDB(dht.humidity, dht.temperature)
  else:
    print(str(datetime.now()) + " failed to read sensor.")
