# Based on code from freenove
from Freenove_DHT import DHT
from time import strftime
from util import datetime_now, getIrrigationDB, getDHT11Pin
from sys import argv

def saveToDB(humidity, temperature):
  print(str(datetime_now()) + " Humidity : %.2f, \t Temperature : %.2f \n"%(humidity, temperature))
  db = getIrrigationDB()
  cur = db.cursor()
  ts = datetime_now().strftime('%Y-%m-%d %H:%M:%S')
  pressure = 0
  sql = """INSERT INTO sensor (timestamp,temperature,pressure,humidity) VALUES (%s,%s,%s,%s)"""
  data = (ts, temperature, pressure, humidity)
  try:
    cur.execute(sql, data)
    db.commit()
  except Exception as e:
    db.rollback()
    print(str(datetime_now().now()) + " Saving Sensor data to DB failed")
    print(e)

if __name__ == '__main__':
  DHTPin = getDHT11Pin()
  if len(argv) == 2:
    DHTPin = int(argv[1])
  dht = DHT(DHTPin)
  chk = dht.readDHT11()
  if (chk is dht.DHTLIB_OK):
    saveToDB(dht.humidity, dht.temperature)
  else:
    print(str(datetime_now()) + " failed to read sensor.")
