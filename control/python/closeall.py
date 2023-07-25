from sys import argv
from irrigationlib import closeAll
from util import datetime_now

if __name__ == '__main__':
  mode = "manual"
  if len(argv) == 2:
    mode = argv[1]
  closeAll()
  print(str(datetime_now()) + " Closed all solenoids" + ", " + mode + " mode.\n")
