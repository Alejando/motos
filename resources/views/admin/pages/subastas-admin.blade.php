<div class="row content shadow">
    <table style="width: 100%; " datatable="" dt-options="dtOptions" dt-columns="dtColumns" dt-instance="dtInstance" class="table table-striped"></table>
    <h1>@{{titulo}}</h1>
    <ul>
        <li ng-repeat="auction in allAuctions">
            <a ng-href="#/subasta/@{{auction.id}}">@{{auction.title}}</a>
        </li>
    </ul>
</div>