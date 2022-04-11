from datetime import datetime
from sys import argv
from irrigationlib import closeAll

if __name__ == '__main__':
  mode = "manual"
  if len(argv) == 2:
    mode = argv[1]
  closeAll()
  print(str(datetime.now()) + " Closed all solenoids" + ", " + mode + " mode.\n")
