<div class="row content shadow">
    <h1>@{{auction.title}}</h1>
    <hr>
    <div ng-bind-html="auction.description"></div>
    <div ng-repeat="photo in photos">
        
        <img src="@{{photo}}" >
    </div>