function updateMovieList() {
    let category = document.getElementById("categoryInput").value;
    var http = new XMLHttpRequest();
    var url = '/movies/list/update';
    var params = 'category=' + category;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            var table = document.getElementById('movies');
            var tBody = table.getElementsByTagName('tbody')[0];
            var rowsHtml = "";
            JSON.parse(http.responseText).forEach(movie => {
                rowsHtml += "<tr>" +
                    "<td>" + movie.title + "</td>" +
                    "<td>" + movie.year + "</td>" +
                    "<td>" + movie.type + "</td>" +
                    '<td><a href="' + movie.poster + '" target="_blank"><img src="' + movie.poster + '" height="50" /></a></td>' +
                    "</tr>";
            });
            tBody.innerHTML = rowsHtml;
        }
    }

    http.send(params);
}