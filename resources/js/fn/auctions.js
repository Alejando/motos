!function () {
    window.jsGlimglam.fn.auctions = {
        addFav : function (code) {
            var url = laroute.route('user.add-fav',{
                'code' : code
            });
            return $.get(url,{},$.noop,'json');
        },
        removeFav : function (code) {
            var url = laroute.route('user.remove-fav',{
                 'code' : code
             });
             return $.get(url,{},$.noop,'json');
         }
    };
}();
