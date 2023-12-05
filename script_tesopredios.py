import mariadb

mydb = mariadb.connect(
    host="localhost",
    user="root",
    password="",
    database="alcaldiarosa"
)

cursor = mydb.cursor()

cursor.execute("ALTER TABLE tesopredios ADD COLUMN id VARCHAR(38) NULL, ADD UNIQUE (id)")
cursor.execute("SELECT CONCAT(cedulacatastral, tot, ord), cedulacatastral, tot, ord FROM tesopredios")

for row in cursor.fetchall():
    cursor.execute("UPDATE tesopredios SET id = ? WHERE cedulacatastral = ? AND tot = ? AND ord = ?", row)

cursor.execute("ALTER TABLE tesopredios MODIFY COLUMN id VARCHAR(38) NOT NULL")

mydb.commit()
mydb.close()
