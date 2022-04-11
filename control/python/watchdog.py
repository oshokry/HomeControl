from irrigationlib import doIrrigate
from util import getIrrigationDB

def getQueryText():
  queryText = "SELECT TimingSchedule.id, TimingSchedule.dayOfWeek, TimingSchedule.solenoidNumber, TimingSchedule.startTime,"\
  " TimingSchedule.lengthSeconds, TimingSchedule.enabled,TimingSchedule.oneOff "\
  "FROM TimingSchedule JOIN DayOfWeek ON(TimingSchedule.dayOfWeek = DayOfWeek.dayOfWeek) "\
  "WHERE DayOfWeek.id = DAYOFWEEK(CURDATE()) "\
  "AND HOUR(CURTIME()) = HOUR(TimingSchedule.startTime) "\
  "AND MINUTE(CURTIME()) = MINUTE(TimingSchedule.startTime) "\
  "AND TimingSchedule.enabled = 1 "\
  "ORDER BY TimingSchedule.startTime;"
  return queryText

def deleteEntry(db, id):
  deleteSql = "DELETE FROM TimingSchedule WHERE id = "
  deleteSql += str(id)
  deleteSql += ";"
  cur = db.cursor()
  cur.execute(deleteSql)
  db.commit()
  cur.close()
    
if __name__ == '__main__':
  db = getIrrigationDB()
  cur = db.cursor()
  cur.execute(getQueryText())
  for row in cur.fetchall():
    mode = "auto"
    if row[6] > 0:
      mode = "auto_oneOff"
      deleteEntry(db, row[0])
    doIrrigate(mode, str(row[2])[-1], row[4])
  cur.close()
  db.close ()
