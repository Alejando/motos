setpoint.directive("fileread", [function () {
    return {
        scope: {
            fileread: "=",
            onselectfile: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {
                
                if(scope.onselectfile){
                    scope.onselectfile(changeEvent,event.target.files);
                }
                if(event.target.files[0]){
                    scope.fileread = event.target.files[0];
                }
//                var reader = new FileReader();
//                reader.onload = function (loadEvent) {
//                    scope.$apply(function () {
//                        scope.fileread = loadEvent.target.result;
//                    });
//                }
//                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
    }
}]);