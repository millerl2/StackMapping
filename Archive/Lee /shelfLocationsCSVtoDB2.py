import MySQLdb
import csv

csv_data = csv.reader(file('shelfLocations2.csv'))

## connect to database
db = MySQLdb.connect("localhost", "millerl2", "16idxh", "millerl2_db")
#db.autocommit(True)

## setup cursor
cursor = db.cursor()

## create BookLocations table
#sql = """CREATE TABLE BookLocations(ShelfNo INT, First NOT NULL, Last NOT NULL, Map INT)"""
#cursor.execute(sql)

## delete entries in table
#for row in csv_data:
#	cursor.execute("""DELETE FROM BookLocations1""")
#	db.commit()

## insert to table
for row in csv_data:
	sql = "INSERT INTO `ShelfLocations` (ShelfNo, X, Y, Width, Height, Map) VALUES (%f, %s, %s, %s, %s,%f);" 
	cursor.execute(sql, row)
	db.commit()

## update data in table
#for row in csv_data:
	#sql2 = "UPDATE BookLocations1 SET first=%s, last=%s, map=%s WHERE shelfno=%s;"
	#cursor.execute(sql2, row)
	#db.commit()
	
	
## Show table
cursor.execute("""SELECT * FROM ShelfLocations""")
print cursor.fetchall()	

### EITHER NOT PRINTING CORRECTLY OR NOT INSERTING CORRECTLY
#for row in data:
#	print row[0], row[1]
## close the connection to the database

cursor.close()
print "DONE"