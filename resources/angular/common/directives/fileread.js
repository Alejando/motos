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

setpoint.directive('filesDagAndDrop',[
    function (){
        return {
            scope : {
                fileread: "=",
                onselectfile: "="
            },
            link : function(scope, element, attributes){
                var inputFile = angular.element(
                        '<input type="file" multiple accept=".jpg,.png" style="display:none">'
                    );
                element.append(inputFile);
                
                inputFile.bind('click', function(e) {
                     e.stopPropagation();
                });
                
                inputFile.bind('change', function(e) {
                    scope.onselectfile(this.files);
                    e.stopPropagation();
                });
                
                element.bind('click', function ($event) {
                    $(inputFile).click();
                    $event.preventDefault();
                });
                
                element.bind('drop',function($event) {                 
                    scope.onselectfile($event.originalEvent.dataTransfer.files);
                    $event.preventDefault();
                });
                
                element.bind('dragover', function ($event) {
                    $event.preventDefault();
                });
            }
        }
    }
]);