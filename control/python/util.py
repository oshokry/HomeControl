import configparser
import MySQLdb
import os

def getConfigFile():
  return os.environ['IRRIGATION_CONFIG_FILE'] #'/home/pi/dev/config.ini'
    
def getLogPath():
  return os.environ['IRRIGATION_LOG_PATH'] #'/home/pi/log/'

def getScriptsPath():
  return os.environ['IRRIGATION_SCRIPT_PATH'] #'/home/pi/dev/scripts/'

def getIrrigationDBName():
  return 'Irrigation';

def getDB(dbName):
  config = configparser.ConfigParser()
  config.read(getConfigFile())
  user = config['database']['user']
  password = config['database']['password']
  host = config['database']['host']
  port = int(config['database']['port'])
  return MySQLdb.connect(user=user, passwd=password, host=host, port=port, db=dbName)

def getIrrigationDB():
  return getDB(getIrrigationDBName())

def getSolenoidPins():
  config = configparser.ConfigParser()
  config.read(getConfigFile())
  Pin1 = int(config['gpio-pins']['S1'])
  Pin2 = int(config['gpio-pins']['S2'])
  Pin3 = int(config['gpio-pins']['S3'])
  Pin4 = int(config['gpio-pins']['S4'])
  Pin5 = int(config['gpio-pins']['S5'])
  Pin6 = int(config['gpio-pins']['S6'])
  Pins = [Pin1, Pin2, Pin3, Pin4, Pin5, Pin6]
  return Pins

def getDHT11Pin():
  config = configparser.ConfigParser()
  config.read(getConfigFile())
  return int(config['gpio-pins']['DHT11'])
