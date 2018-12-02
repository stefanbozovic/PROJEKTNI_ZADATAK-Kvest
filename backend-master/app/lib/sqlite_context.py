import sqlite3

class SQLiteConnection(object): # context manager
    def __init__(self,path):
        self.DB_PATH=path
        self.conn=None
        self.c=None

    def __enter__(self):
        self.conn = sqlite3.connect(self.DB_PATH)
        self.c = self.conn.cursor()
        self.c.execute("PRAGMA foreign_keys = ON;")
        self.conn.commit()
        return self.c

    def __exit__(self, exc_type, exc_val, exc_tb):
        self.conn.commit()
        self.c.close()
        self.conn.close()
