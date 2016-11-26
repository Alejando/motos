setpoint.factory('Bookmarks', ['User', function(User) {
  	//var arrayBookmarks = [];
  	User.getIdProductInBookmarks().then(function(data){
    	//arrayBookmarks =  data; 
    	return data;       
     });

  	//console.log(arrayBookmarks);
  	
    //return arrayBookmarks;
}]);
