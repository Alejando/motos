!function(){
    var $pre = $('pre');
    var urls = [ 
        laroute.route('close.auctions'),
        laroute.route('start.auctions'),
        laroute.route('check.faults')
    ];
    setInterval(function() {
        for(url in urls) {
            $.get(urls[url], {}, function(res) {
                console.log(res);
            }, 'text');
        }
    }, 1000);
} ();