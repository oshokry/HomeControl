from sys import argv
from irrigationlib import doIrrigate

if __name__ == '__main__':
  solenoid = 1
  tSeconds = 1
  mode = "manual"
  if len(argv) == 4:
    solenoid = int(argv[1])
    tSeconds = int(argv[2])
    mode = argv[3]
  doIrrigate(mode, solenoid, tSeconds)
