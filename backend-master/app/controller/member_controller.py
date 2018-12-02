import sqlite3

from model.team import Team
from model.team_member import TeamMember
from lib.sqlite_context import SQLiteConnection
DB_PATH = '../db/hzs.db'  # can do abs path too!

def _connect():
    conn = sqlite3.connect(DB_PATH)
    c = conn.cursor()
    c.execute("PRAGMA foreign_keys = ON;")
    conn.commit()
    return conn



def get_member(team_id,member_id):
    with SQLiteConnection(DB_PATH) as c:
        query = """SELECT id, name, description, photo_url, team_uuid FROM team WHERE id=?"""
        c.execute(query, (team_id,))
        t = c.fetchone()
        query = """SELECT id,first_name, last_name, email, phone_number, school, city, team_id FROM team_member WHERE team_id=? AND id=?"""
        c.execute(query, (team_id,member_id,))
        m = c.fetchone()
        if m is None:
            return None
        
        team = Team(id=t[0], name=t[1], description=t[2], photo_url=t[3], team_uuid=t[4])

        member = TeamMember(id=m[0], first_name=m[1], last_name=m[2], email=m[3], phone_number=m[4],
                                        school=m[5], city=m[6], team=team)

    return member

def create_team_member(data,team_id):
    with SQLiteConnection(DB_PATH) as c:
        member_query = """INSERT INTO team_member (first_name, last_name, email, phone_number, school, city, team_id) VALUES (?,?,?,?,?,?,?)"""
        c.execute(member_query,(data['first_name'], data['last_name'], data['email'], data['phone_number'], data['school'], data['city'], team_id))
        member_id=c.lastrowid;
    return get_member(team_id,member_id)
def update_member(data,team_id,member_id):
    with SQLiteConnection(DB_PATH) as c:

        team_query = """UPDATE team_member SET first_name=?, last_name=?, email=?, phone_number=?, school=?, city=? WHERE team_id=? AND id=?"""
        c.execute(team_query, (data['first_name'], data['last_name'], data['email'], data['phone_number'], data['school'], data['city'],team_id,member_id))

    return get_member(team_id,member_id)

def delete_member(team_id,member_id):
    conn = _connect()

    with conn:
        team_query = """DELETE FROM team_member WHERE team_id=? AND id=?"""
        status = conn.execute(team_query, (team_id,member_id))
        success = False
        if status.rowcount == 1:
            success = True

    return success