(function () {

    var laroute = (function () {

        var routes = {

            absolute: true,
            rootUrl: 'http://glimglam.dev/',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"GlimGlam\Http\Controllers\Home@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin","name":null,"action":"GlimGlam\Http\Controllers\AdminController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"pages\/admin\/{view}.html","name":null,"action":"GlimGlam\Http\Controllers\PagesCtrl@admin"},{"host":null,"methods":["POST"],"uri":"file-upload","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"tests\/pako\/covers\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"GlimGlam\Http\Controllers\TestPakoCtrl@getCovers"},{"host":null,"methods":["GET","HEAD"],"uri":"tests\/pako\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"GlimGlam\Http\Controllers\TestPakoCtrl@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"tests\/pako","name":null,"action":"GlimGlam\Http\Controllers\TestPakoCtrl@getIndex"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"tests\/pako\/{_missing}","name":null,"action":"GlimGlam\Http\Controllers\TestPakoCtrl@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":null,"action":"Closure"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"GlimGlam\Http\Controllers\Auth\AuthController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":null,"action":"GlimGlam\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":null,"action":"GlimGlam\Http\Controllers\Auth\AuthController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"GlimGlam\Http\Controllers\Auth\AuthController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token?}","name":null,"action":"GlimGlam\Http\Controllers\Auth\PasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":null,"action":"GlimGlam\Http\Controllers\Auth\PasswordController@sendResetLinkEmail"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":null,"action":"GlimGlam\Http\Controllers\Auth\PasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"home","name":null,"action":"GlimGlam\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/upcoming\/{n?}","name":"auction.upcoming","action":"GlimGlam\Http\Controllers\Api\AuctionController@getUpcoming"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/code\/{code}","name":"auction.getByCode","action":"GlimGlam\Http\Controllers\Api\AuctionController@getByCode"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/slug\/{slug}","name":"Content.slug","action":"GlimGlam\Http\Controllers\Api\ContentController@slug"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category\/all-for-datatables","name":"category.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\CategoryController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category","name":"category","action":"GlimGlam\Http\Controllers\Api\CategoryController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category\/create","name":"category.create","action":"GlimGlam\Http\Controllers\Api\CategoryController@create"},{"host":null,"methods":["POST"],"uri":"api\/category","name":"category.store","action":"GlimGlam\Http\Controllers\Api\CategoryController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category\/{category}","name":"category.show","action":"GlimGlam\Http\Controllers\Api\CategoryController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category\/{category}\/edit","name":"category.edit","action":"GlimGlam\Http\Controllers\Api\CategoryController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/category\/{category}","name":"category.update","action":"GlimGlam\Http\Controllers\Api\CategoryController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/category\/{category}","name":"category.destroy","action":"GlimGlam\Http\Controllers\Api\CategoryController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/category\/{id}\/relation\/{relation}","name":"category.relation","action":"GlimGlam\Http\Controllers\Api\CategoryController@relation"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference\/all-for-datatables","name":"preference.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\PreferenceController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference","name":"preference","action":"GlimGlam\Http\Controllers\Api\PreferenceController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference\/create","name":"preference.create","action":"GlimGlam\Http\Controllers\Api\PreferenceController@create"},{"host":null,"methods":["POST"],"uri":"api\/preference","name":"preference.store","action":"GlimGlam\Http\Controllers\Api\PreferenceController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference\/{preference}","name":"preference.show","action":"GlimGlam\Http\Controllers\Api\PreferenceController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference\/{preference}\/edit","name":"preference.edit","action":"GlimGlam\Http\Controllers\Api\PreferenceController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/preference\/{preference}","name":"preference.update","action":"GlimGlam\Http\Controllers\Api\PreferenceController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/preference\/{preference}","name":"preference.destroy","action":"GlimGlam\Http\Controllers\Api\PreferenceController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/preference\/{id}\/relation\/{relation}","name":"preference.relation","action":"GlimGlam\Http\Controllers\Api\PreferenceController@relation"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address\/all-for-datatables","name":"address.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\AddressController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address","name":"address","action":"GlimGlam\Http\Controllers\Api\AddressController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address\/create","name":"address.create","action":"GlimGlam\Http\Controllers\Api\AddressController@create"},{"host":null,"methods":["POST"],"uri":"api\/address","name":"address.store","action":"GlimGlam\Http\Controllers\Api\AddressController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address\/{address}","name":"address.show","action":"GlimGlam\Http\Controllers\Api\AddressController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address\/{address}\/edit","name":"address.edit","action":"GlimGlam\Http\Controllers\Api\AddressController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/address\/{address}","name":"address.update","action":"GlimGlam\Http\Controllers\Api\AddressController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/address\/{address}","name":"address.destroy","action":"GlimGlam\Http\Controllers\Api\AddressController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/address\/{id}\/relation\/{relation}","name":"address.relation","action":"GlimGlam\Http\Controllers\Api\AddressController@relation"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/all-for-datatables","name":"auction.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\AuctionController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction","name":"auction","action":"GlimGlam\Http\Controllers\Api\AuctionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/create","name":"auction.create","action":"GlimGlam\Http\Controllers\Api\AuctionController@create"},{"host":null,"methods":["POST"],"uri":"api\/auction","name":"auction.store","action":"GlimGlam\Http\Controllers\Api\AuctionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{auction}","name":"auction.show","action":"GlimGlam\Http\Controllers\Api\AuctionController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{auction}\/edit","name":"auction.edit","action":"GlimGlam\Http\Controllers\Api\AuctionController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/auction\/{auction}","name":"auction.update","action":"GlimGlam\Http\Controllers\Api\AuctionController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/auction\/{auction}","name":"auction.destroy","action":"GlimGlam\Http\Controllers\Api\AuctionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{id}\/relation\/{relation}","name":"auction.relation","action":"GlimGlam\Http\Controllers\Api\AuctionController@relation"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/all-for-datatables","name":"content.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\ContentController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content","name":"content","action":"GlimGlam\Http\Controllers\Api\ContentController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/create","name":"content.create","action":"GlimGlam\Http\Controllers\Api\ContentController@create"},{"host":null,"methods":["POST"],"uri":"api\/content","name":"content.store","action":"GlimGlam\Http\Controllers\Api\ContentController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/{content}","name":"content.show","action":"GlimGlam\Http\Controllers\Api\ContentController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/{content}\/edit","name":"content.edit","action":"GlimGlam\Http\Controllers\Api\ContentController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/content\/{content}","name":"content.update","action":"GlimGlam\Http\Controllers\Api\ContentController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/content\/{content}","name":"content.destroy","action":"GlimGlam\Http\Controllers\Api\ContentController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/content\/{id}\/relation\/{relation}","name":"content.relation","action":"GlimGlam\Http\Controllers\Api\ContentController@relation"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/all-for-datatables","name":"user.all-for-datatables","action":"GlimGlam\Http\Controllers\Api\UserController@getAllForDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":"user","action":"GlimGlam\Http\Controllers\Api\UserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/create","name":"user.create","action":"GlimGlam\Http\Controllers\Api\UserController@create"},{"host":null,"methods":["POST"],"uri":"api\/user","name":"user.store","action":"GlimGlam\Http\Controllers\Api\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/{user}","name":"user.show","action":"GlimGlam\Http\Controllers\Api\UserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/{user}\/edit","name":"user.edit","action":"GlimGlam\Http\Controllers\Api\UserController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"api\/user\/{user}","name":"user.update","action":"GlimGlam\Http\Controllers\Api\UserController@update"},{"host":null,"methods":["DELETE"],"uri":"api\/user\/{user}","name":"user.destroy","action":"GlimGlam\Http\Controllers\Api\UserController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/{id}\/relation\/{relation}","name":"user.relation","action":"GlimGlam\Http\Controllers\Api\UserController@relation"},{"host":null,"methods":["POST"],"uri":"api\/auction\/{id}\/addPhoto","name":null,"action":"GlimGlam\Http\Controllers\Api\AuctionController@addPhoto"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{id}\/photos","name":null,"action":"GlimGlam\Http\Controllers\Api\AuctionController@getPhotos"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{id}\/photo\/{file}","name":null,"action":"GlimGlam\Http\Controllers\Api\AuctionController@getPhoto"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/auction\/{code}\/thumbailn\/{version}","name":"auction.getCover","action":"GlimGlam\Http\Controllers\Api\AuctionController@getThumbnail"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

