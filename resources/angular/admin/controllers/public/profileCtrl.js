glimglam.controller('public.profileCtrl', function ($scope, User) {
    var setBrithday = function () {
        var birth = $scope.user.birthday;
        if(birth){
            $scope.brithday.day = birth.getDate().toString();
            $scope.brithday.month = (birth.getMonth() + 1).toString();
            $scope.brithday.year = birth.getFullYear().toString();
        }        
    };
    //<editor-fold defaultstate="collapsed" desc="getAuthUser">
    User.getAuthUser().then(function (user) {
        $('.div-profile').slideDown('slow');
        $scope.user = user;
        $scope.user.backup();
        setBrithday();
        $scope.getWins();
        $scope.getEnrolled();
        $scope.user.getCurrentAuctions().then(function(actual){
            console.log(actual);
            $scope.actual = actual;
        });
        $scope.user.getAuctionsInfo().then(function(info){
        $scope.myTotalEnrollments = info.totalEnrollments;
        $scope.myTotalWins = info.totalWins;
            console.log(info);
        });
    });
    //</editor-fold>
    $scope.section = 'profile';
    //<editor-fold defaultstate="collapsed" desc="setSection">
    $scope.setSection = function (section) {
        
        $scope.section = section;
        if(section === 'favs') {
            $scope.getFavs();
        }
        $scope.user.rollback();
        $scope.newPassword = "";
        $scope.confirmPassword = '';
        $scope.password = '';
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Imagen de perfil">
    $('#img-profile').change(function () {
        var file = this.files[0];
        if (file) {
            console.log(file.type);
            if (file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
                alert("Solo se admiten imagenes JPG");
                return;
            }

            var reader = new FileReader();
            reader.onloadend = function () {
                var data = new FormData();
                data.append('img', file);
                var url = laroute.route('user.save-img-profile');
                $.ajax({
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        var urlImg = laroute.route('user.img-avatar', {
                            'userId': $scope.user.id
                        }) + '?' + (new Date).getTime();
                        console.log(urlImg);
                        $('#foto-perfil').attr('src', urlImg);
                    }
                });
            };
            reader.readAsDataURL(file);
        }
    });
    $scope.changeImg = function () {
        $('#img-profile').click();
    };

    //</editor-fold>
    $scope.brithday = {
        'day': "0",
        'month': "0",
        'year': "0"
    };
    $scope.errors = {};
    $scope.getFavs = function () {
        $scope.user.getFavs().then(function(favs) {
            $scope.favs = favs;
        });
    };
    $scope.getWins = function () {
        $scope.user.getWins().then(function(wins) { 
            $scope.wins = wins;
        });
    };
    $scope.getEnrolled = function() {
        $scope.user.getEnrolled().then(function(enrolleds) {
            $scope.enrolleds = enrolleds;
        });
    };
    $scope.removeFav = function(auction, $event){
        $event.preventDefault();
        jsGlimglam.fn.auctions.removeFav(auction.code).done(function () {
            $scope.$apply(function(){
                $scope.favs.splice($scope.favs.indexOf(auction), 1);
            });
        });
    };
    
    //<editor-fold defaultstate="collapsed" desc="updateProfile">
    $scope.updateProfile = function () {
        console.log($scope.brithday.day, $scope.brithday.month, $scope.brithday.year);
        if(
            $scope.brithday.day==0 ||
            $scope.brithday.month==0 ||
            $scope.brithday.year==0
                
        ) {
            bootbox.alert("Por favor ingresa tu fecha de nacimiento");
            return;
        }
        if(!$scope.user.password){
            bootbox.alert("Ingresa tu contraseña actual para autorizar los cambios");
            return ;
        }
        if ($scope.newPassword) {
            if ($scope.confirmPassword !== $scope.newPassword) {
                $scope.errors.confirmPassword = "Tu confirmación no coicide";
                return;
            } else {
                $scope.errors.confirmPassword = "";
            }
            $scope.user.newPassword = $scope.newPassword;
        }
        if($scope.user.birthday === null) {
            $scope.user.birthday = new Date();
        }
        var birthday = $scope.user.birthday;
        birthday.setDate($scope.brithday.day);
        birthday.setMonth($scope.brithday.month - 1);
        birthday.setYear($scope.brithday.year);
        $scope.user.save().then(function (res) {
            if (res.error) {
                $scope.errors.password = res.msj;
                if($scope.errors.password){
                    bootbox.alert(res.msj);
                    return;
                }
                $scope.errors.confirmPassword = "";
                return;
            }
            $scope.errors.password = false;
            $('#nombre-usr').html("@" + $scope.user.email.split('@')[0]);
            $('.pass').val("");
            var $box = bootbox.alert("Tus datos fueron actualizados correctamente");
            $box.css('zIndex', 2000);
        });
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="rollback">
    $scope.rollback = function () {
        $scope.user.rollback();
        $('.pass').val("");
        if ($scope.user.birthday !== null) {
            setBrithday();
        } else {
            $scope.brithday.day = "0";
            $scope.brithday.month = "0";
            $scope.brithday.year = "0";
        }
    };
    //</editor-fold>

});