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

    var url = '/movies/search';
    var params = 'title=' + title + '&yearFrom=' + yearFrom + '&yearUntil=' + yearUntil + '&category=' + category;

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