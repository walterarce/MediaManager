
<h4 class="d-flex justify-content-between align-items-center mb-3">
    <span class="badge badge-secondary badge-pill">{{ $ctrl.Peliculas.length }}</span>
</h4>
<?php
$url = 'http';
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$url .= "s";}
$url .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
    $url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
    $url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}

echo $url;
?>
<table class="table table-hover">
    <thead></thead>
    <tbody>
       <tr  data-ng-repeat="c in $ctrl.Peliculas.results | orderBy:'original_title'" class="table-active">
           <td>{{ c.original_title }}</td>
           <td>{{c.overview}}</td>
           <td><div><a ng-href=<?php echo $url."modulos/detalle.php?idpelicula="?>{{c.id}}>
               <img ng-src="https://image.tmdb.org/t/p/w500{{c.poster_path}}"  class="img-thumbnail" >
           </a> </div></td>
       </tr>

    </tbody>
</table>


<!--            <span class="text-nowrap">-->
<!--                    <button type="button" class="btn btn-sm btn-info" data-ng-click="$ctrl.setPage(2)" data-ng-disabled="$ctrl.nuevaPelicula!=null">Editar</button>-->
<!--                    <button type="button" class="btn btn-sm btn-danger" data-ng-click="$ctrl.setPage(2)" data-ng-disabled="$ctrl.nuevaPelicula!=null && $ctrl.nuevaPelicula.id==c.id">Borrar</button>-->
<!--                </span>-->




