setpoint.service('AuthSevice', function(User){
    var user = new User(window.user);
    window.user = undefined;
    this.user = function() {
        return user;
    }
});