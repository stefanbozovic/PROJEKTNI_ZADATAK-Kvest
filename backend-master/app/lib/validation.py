
def team_validation(data):
    valid=True
    if not data.get('name'):
        valid=False
        return False
    for member in data['team_members']:
        valid=member_validation(member)
        if not valid:
            return False
    return valid

def member_validation(data):
    valid=True
    if not(data.get('first_name') and data.get('last_name') and data.get('email')):
        valid=False
    return valid
    