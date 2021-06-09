<div class="card mb-3" xmlns="http://www.w3.org/1999/html">
    <div class="card-header"> <h3>{{$ctrl.Peliculas.title}}</h3> <<</div>
    <div class="card-body">
        <section class="col"><h5 class="card-title">{{$ctrl.Peliculas.original_title}} </h5>
            <h6 class="card-subtitle text-muted">{{$ctrl.Peliculas.release_date}}</h6></section>
            <section class="col align-self-sm-end" ng-show="$ctrl.Peliculas.homepage"><h6><a href=" {{$ctrl.Peliculas.homepage}}" class="link-danger">HomePage</a></h6></section>

    </div>
<!--    <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">-->
<!--        <rect width="100%" height="100%" fill="#868e96"></rect>-->
<!--        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>-->
<!--    </svg>-->
    <div class="card-body">
        <table class="table table-hover">
<!--            <thead>-->
<!--            <tr>-->
<!--                <th scope="col">Type</th>-->
<!--                <th scope="col">Column heading</th>-->
<!--                <th scope="col">Column heading</th>-->
<!--                <th scope="col">Column heading</th>-->
<!--            </tr>-->
<!--            </thead>-->
            <tbody>
            <tr class="table-dark">
<!--                <th scope="row">Dark</th>-->
                <td> <div class="card-img">
                        <img ng-src="https://image.tmdb.org/t/p/w500{{$ctrl.Peliculas.poster_path}}" class="img-responsive">
                    </div></td>
                <td><div class="card-text">
                        <h3>Resumen</h3>
                        <p>{{$ctrl.Peliculas.overview}}</p>

                    </div></td>
                <td><div>
                        <span  data-ng-repeat="c in $ctrl.Peliculas.genres"> <span class="badge bg-primary">{{c.name}}</span></span>
                    </div>
                    <div data-ng-repeat="t in $ctrl.Trailers">
                        <object data='https://www.youtube.com/embed/{{t.key}}?autoplay=1' width='280px' height='157px'>
                    </div></td>
            </tr>
            </tbody>
        </table>
        <div class="card-body">
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>
</div>
