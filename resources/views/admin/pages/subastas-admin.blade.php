<div class="row content shadow">
    <h1>@{{titulo}}</h1>
    <ul>
        <li ng-repeat="auction in allAuctions">
            <a ng-href="#/subasta/@{{auction.id}}">@{{auction.title}}</a>
        </li>
    </ul>
</div>