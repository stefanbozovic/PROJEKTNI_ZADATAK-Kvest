from flask import Blueprint, request, jsonify

from controller.main_controller import get_all_teams, create_team, get_team, get_team_id, update_team, delete_team
from controller.member_controller import get_member, update_member, delete_member ,create_team_member
from lib.validation import team_validation,member_validation

teams = Blueprint('teams', __name__, url_prefix='/teams')


@teams.route('/hello', methods=['GET'])
def hello_world():
    return 'Hello, World!'


@teams.route('/', methods=['GET', 'POST'])
def teams_view():
    if request.method == 'GET':  # get all teams
        all_teams = get_all_teams()

        response_body = [t.to_dict() for t in all_teams]
        return jsonify(response_body), 200

    if request.method == 'POST':  # create a new team
        
        body = request.json
        if(team_validation(body)): # validate required data
            if len(body['team_members'])==3 or len(body['team_members'])==4: # check team_members count
                created = create_team(body)
                return jsonify(created), 201
            else:
                return jsonify({'error':'team must have 3 or 4 team members'}) , 404
        else:
            return jsonify({'error':'validation not pass'})




@teams.route('/<string:team_uuid>', methods=['GET', 'PUT', 'DELETE'])
def single_team_view(team_uuid):
    if request.method == 'GET':  # get the team
        team = get_team(team_uuid)
        if team is None:
            return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404

        response_body = team.to_dict()
        return jsonify(response_body), 200

    if request.method == 'PUT':  # update the team
        body = request.json
        if(team_validation(body)):  # validate required data
            updated = update_team(body,team_uuid)
            if updated is None:
                return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404

            return jsonify(updated), 200
        else:
            return jsonify({'error':'validation not pass'})

    if request.method == 'DELETE':  # remove the team
        success = delete_team(team_uuid)

        if not success:
            return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404

        return jsonify({}), 204

@teams.route('/<string:team_uuid>/members', methods=['GET', 'POST'])
def member_view(team_uuid):
    if request.method == 'GET':  # get all members in team
        team=get_team(team_uuid);
        if team is None:
            return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404
        all_members = team.team_members;

        response_body = [m.to_dict() for m in all_members]
        return jsonify(response_body), 200

    if request.method == 'POST':  # create a new member
        body = request.json
        if(member_validation(body)): # validate required data
            team=get_team(team_uuid);
            if team is None:
                return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404
            if len(team.team_members)<=3: # check team_members count
                created = create_team_member(body,team.id)
                return jsonify(created.to_dict()), 201
            else:
                return jsonify({'error':'if you add new member team will have 5 members'}) , 404
        else:
            return jsonify({'error':'validation not pass'})
@teams.route('/<string:team_uuid>/members/<int:member_id>', methods=['GET', 'PUT', 'DELETE'])
def single_team_member_view(team_uuid,member_id):
    team_id = get_team_id(team_uuid)
    if team_id is None: # check if team_id exists
        return jsonify({'error': 'team with unique id {} not found'.format(team_uuid)}), 404

    if request.method == 'GET': 
        member=get_member(team_id,member_id)
        if member is None: # check if member exists within team with team_id 
            return jsonify({'error': 'member with  id {} not found in team with unique id {}'.format(member_id,team_uuid)}), 404
        return jsonify(member.to_dict()), 200;

    if request.method == 'PUT': 
        body = request.json
        if(member_validation(body)):
            member=update_member(body,team_id,member_id)
            if member is None:
                return jsonify({'error': 'member with  id {} not found in team with unique id {}'.format(member_id,team_uuid)}), 404
            return jsonify(member.to_dict()), 200;
        else:
            return jsonify({'error':'validation not pass'})
        
    if request.method == 'DELETE':
        team=get_team(team_uuid);
        if len(team.team_members)==4:
            success = delete_member(team_id,member_id)
            if not success:
                return jsonify({'error': 'member with  id {} not found in team with unique id {}'.format(member_id,team_uuid)}), 404

            return jsonify({}), 204
        else:
            return jsonify({'error': 'if you delete member team will have 2 members'.format(member_id,team_uuid)}), 404
    
    
