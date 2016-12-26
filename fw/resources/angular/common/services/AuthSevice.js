setpoint.service('AuthSevice', function(User){
    var user = window.user ? new User(window.user): null; 
    window.user = undefined; 
    this.user = function() {
        return user;
    }
});