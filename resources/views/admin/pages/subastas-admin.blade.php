<div class="row content shadow">
    
    <table datatable="" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1</td>
        <td>Foo</td>
        <td>Bar</td>
    </tr>
    <tr>
        <td>123</td>
        <td>Someone</td>
        <td>Youknow</td>
    </tr>
    <tr>
        <td>987</td>
        <td>Iamout</td>
        <td>Ofinspiration</td>
    </tr>
    </tbody>
</table>
    
    <h1>@{{titulo}}</h1>
    <ul>
        <li ng-repeat="auction in allAuctions">
            <a ng-href="#/subasta/@{{auction.id}}">@{{auction.title}}</a>
        </li>
    </ul>
</div>