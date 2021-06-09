angular.module('moviesApp',[])
   .component('movies',{
       templateUrl : 'http://localhost/Final/MediaManager/templates/listadocine_tlp.php',
       controller : function ($http,$scope){
           var keyapi= '7f7fe82f4927b1c30d8364d1170db2c1';
           var idioma ='en';
           var ctrl = this;
           var pagina = getParameterByName('page');

           var initMovies = function () {
               $http.get('https://api.themoviedb.org/3/discover/movie?api_key=' +
                   keyapi +
                   '&language=' +
                   idioma +
                   '&sort_by=popularity.desc&include_adult=false&include_video=false&page=' +
                   pagina +
                   '&with_watch_monetization_types=flatrate')
                   .then(function (response) {
                       ctrl.Peliculas = response.data;
                       ctrl.Paginas = response.data.total_pages;
                       console.log(response.data.results);
                       console.log(ctrl.Peliculas);
                   })
                   .catch(function (response) {
                       console.error(response);
                   })
           };
           this.$onInit = function () {
               initMovies();
               ctrl.nuevaPelicula= null;
           }
       }
   });

function getParameterByName(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}