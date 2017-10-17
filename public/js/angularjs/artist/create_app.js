var ArtistCreateApp;
(function(ArtistCreateApp_1) {

    var ArtistCreateService = (function(){
        function ArtistCreateService($http){
            var _this = this;
            this.$http = $http;
            //service here
        }
        ArtistCreateService.$inject = ['$http'];
        return ArtistCreateService;
    }());
    var ArtistCreateApp = (function(){
        function ArtistCreateApp(ArtistCreateService){
            var _this = this;
            this.ArtistCreateService = ArtistCreateService;
            this.$onInit = function(){ };
            // app here
            
            this.message = "hallo";
        }
        ArtistCreateApp.$inject = [];
        return ArtistCreateApp;
    }());
    angular.module('ArtistCreateApp',['ngRoute'])
        .controller('ArtistCreateApp',ArtistCreateApp);

})(ArtistCreateApp || (ArtistCreateApp = {}));