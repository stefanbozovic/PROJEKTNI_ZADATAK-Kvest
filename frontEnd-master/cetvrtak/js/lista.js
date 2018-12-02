
var div = document.getElementById('listaTimova');

var requestURL = "http://142.93.173.116:5000/teams/";

var request = new XMLHttpRequest();

request.open('GET', requestURL);
request.responseType = 'json';
request.send();

request.onload = function () {
    var timovi = request.response;
    ispisiOpsteInformacije(timovi);
}

function ispisiOpsteInformacije(jsonObj) {
    for (var i = 0; i < jsonObj.length; i++) {
        var elementNiza = jsonObj[i];

        var team = document.createElement("IMG");
        team.setAttribute("src", "img/team.jpg");
        team.setAttribute("width", "200");
        team.setAttribute("height", "200");
        team.setAttribute("align", "center");

        var myDiv = document.createElement('div');
        myDiv.classList.add("tim");
        var myH1 = document.createElement('h1');
        myH1.textContent = elementNiza['name'];

        myDiv.appendChild(team);
        myDiv.appendChild(myH1);

        var myPar = document.createElement('p');
        myPar.textContent = 'Opis tima: ' + elementNiza['description'];
        myDiv.appendChild(myPar);
        myDiv.appendChild(document.createElement("br"));

        var clanovi = elementNiza['team_members'];
        ispisiClanove(clanovi, myDiv);
        
        myDiv.appendChild(document.createElement('br'));
    }
    myDiv.appendChild(document.createElement('br'));
}

function ispisiClanove(clanovi, myDiv) {

    for (var j = 0; j < clanovi.length; j++) {
        var myArticle = document.createElement('article');
        var imeprezime = document.createElement('h2');
        var email = document.createElement('p');
        var brojTelefona = document.createElement('p');
        var skola = document.createElement('p');
        var mestoSkole = document.createElement('p');

        var mail = document.createElement("IMG");
        mail.setAttribute("src", "img/mail.png");
        mail.setAttribute("width", "25");
        mail.setAttribute("height", "35");

        var phone = document.createElement("IMG");
        phone.setAttribute("src", "img/phone.png");
        phone.setAttribute("width", "25");
        phone.setAttribute("height", "35");

        var school = document.createElement("IMG");
        school.setAttribute("src", "img/school.png");
        school.setAttribute("width", "25");
        school.setAttribute("height", "40");

        var location = document.createElement("IMG");
        location.setAttribute("src", "img/location.png");
        location.setAttribute("width", "20");
        location.setAttribute("height", "30");

        imeprezime.textContent = 'Ime i prezime: ' + clanovi[j].first_name+" "+ clanovi[j].last_name;
        
        email.textContent = clanovi[j].email;
        brojTelefona.textContent = clanovi[j].phone_number;
        skola.textContent = clanovi[j].school;
        mestoSkole.textContent = clanovi[j].city;

        myArticle.appendChild(imeprezime);
        var jednastavka=document.createElement("div");
        jednastavka.appendChild(mail);
        jednastavka.appendChild(email);
        myArticle.appendChild(jednastavka);
        
        
        var jednastavka=document.createElement("div");
        jednastavka.appendChild(phone);
        jednastavka.appendChild(brojTelefona);
        myArticle.appendChild(jednastavka);

        myArticle.appendChild(document.createElement("br"));
        myArticle.appendChild(school);
        myArticle.appendChild(skola);

        myArticle.appendChild(location);
        myArticle.appendChild(mestoSkole);

        myArticle.classList.add('clanoviTima');

        myDiv.appendChild(myArticle);
    

    }

    div.appendChild(myDiv);
    div.classList.add('container');
}

