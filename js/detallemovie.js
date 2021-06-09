angular.module('DetalleApp',[])
  .component('detallemovie', {
        templateUrl : '../templates/detalle_tlp.php',
      controller: function ($http,$scope)
      {
          var keyapi= '7f7fe82f4927b1c30d8364d1170db2c1';
          var idioma ='es';
          var ctrl = this;
          var id =getParameterByName('idpelicula');



          var movie = function () {
              $http.get('https://api.themoviedb.org/3/movie/' + id +
                  '?api_key=' +
                  keyapi +
                  '&language=' +
                  idioma)
                  .then(function (response) {
                      ctrl.Peliculas = response.data;
                      console.log(ctrl.Peliculas);
                  })
                  .catch(function (response) {
                      console.error(response);
                  })
          };
          var trailers = function () {
              $http.get('https://api.themoviedb.org/3/movie/' + id +
                  '/videos?api_key=' +
                  keyapi +
                  '&language=' +
                  idioma)
                  .then(function (response) {
                      ctrl.Trailers = response.data.results;
                      console.log(ctrl.Trailers);
                  })
                  .catch(function (response) {
                      console.error(response);
                  })
          };
          this.$onInit = function () {
              movie();
              trailers();
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