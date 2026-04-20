$(document).ready(function(){

    $('body').on('submit','#searchform',function(e){

        let searchtext = $('#searchtext').val();
        getmovies(searchtext);
        e.preventDefault();
    });

});


$(document).on('pagebeforeshow','#movie', function(){

    let movieid = sessionStorage.getItem('movieid');
    getmovie(movieid);
});


function movieClicked(id){
    sessionStorage.setItem('movieid',id);
    $.mobile.changePage('movie.html');
}


function getmovies(name){
    $.ajax({
        method:'GET',
        url:'https://www.omdbapi.com/?apikey=7c73fd49&s=' +name
    }).done(function(data){
        let movies = data.Search;
        let output = '';

        $.each(movies,function(index,movie){
            output += `
            <li>
                <a onclick="movieClicked('${movie.imdbID}')" href="#">
                    <img src="${movie.Poster}">
                    <h2>${movie.Title}</h2>
                    <p>Release Your : ${movie.Year}</p>
                </a>
            </li>

            `;
        });
        $('#movies').html(output).listview('refresh');


    });
}


function getmovie(movieid){
    $.ajax({
        method:'GET',
        url:'https://www.omdbapi.com/?apikey=7c73fd49&i=' +movieid
    }).done(function(movie){

        let movietop = `
        <div style="text-align:center">

            <h1>${movie.Title}</h1>
            <img src="${movie.Poster}">

        </div>
        `;
        $('#movietop').html(movietop);

        let moviedetails = `
        
        <li><strong>Genre:</strong>${movie.Genre}</li>
        <li><strong>Reted:</strong>${movie.Reted}</li>
        <li><strong>Released:</strong>${movie.Released}</li>
        <li><strong>Runtime:</strong>${movie.Runtime}</li>
        <li><strong>imdbRating:</strong>${movie.imdbRating}</li>
        <li><strong>imdbVotes:</strong>${movie.imdbVotes}</li>
        <li><strong>Actors:</strong>${movie.Actors}</li>
        <li><strong>Director:</strong>${movie.Director}</li>
        `;
        $('#moviedetails').html(moviedetails).listview('refresh');

    });
}