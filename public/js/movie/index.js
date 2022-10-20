function updateMovieList() {
    let category = document.getElementById("categoryInput").value;

    if (category == "") {
        alert("Category must be included");
        return false;
    }

    var url = '/movies/update';
    var params = 'category=' + category;

    var http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            document.getElementById("categorySearch").value = category;
            fillTable(http.responseText);
        }
    }
    http.send(params);
}

function search() {
    let title = document.getElementById("titleSearch").value;
    let yearFrom = document.getElementById("yearFromSearch").value;
    let yearUntil = document.getElementById("yearUntilSearch").value;
    let category = document.getElementById("categorySearch").value;

    let sortParam1 = document.getElementById("sortParam1").value;
    let sortDir1 = document.getElementById("sortDir1").value;
    let sortParam2 = document.getElementById("sortParam2").value;
    let sortDir2 = document.getElementById("sortDir2").value;

    var url = '/movies/search';
    var params = 'title=' + title + '&yearFrom=' + yearFrom + '&yearUntil=' + yearUntil + '&category=' + category;
    params += '&sort=' + sortParam1 + '-' + sortDir1 + '-' + sortParam2 + '-' + sortDir2;

    var http = new XMLHttpRequest();
    http.open('GET', url + "?" + params, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            fillTable(http.responseText);
        }
    }
    http.send();
}

function fillTable(movies) {
    var table = document.getElementById('movies');
    var tBody = table.getElementsByTagName('tbody')[0];
    var rowsHtml = "";
    JSON.parse(movies).forEach(movie => {
        rowsHtml += "<tr>" +
            "<td>" + movie.title + "</td>" +
            "<td>" + movie.year + "</td>" +
            "<td>" + movie.type + "</td>" +
            '<td><a href="' + movie.poster + '" target="_blank"><img src="' + movie.poster + '" height="50" /></a></td>' +
            "</tr>";
    });
    tBody.innerHTML = rowsHtml;
}
