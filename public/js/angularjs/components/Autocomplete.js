var Components;
(function (Components) {
    var Autocomplete = (function () {
        function Autocomplete($http, $timeout) {
            var _this = this;
            this.$http = $http;
            this.$timeout = $timeout;
            this.$onInit = function () { };
            this.isOpen = false;
            this.text = "";
            this.items = [];
            this.selecteditem = null; // selected item
            this.activeitem = null; // focused item
            this.showSuggestions = function ($event) {
                switch ($event.keyCode) {
                    case 37: // left
                    case 39:// right
                        break;
                    case 38:// up
                        if (!_this.isOpen) {
                            _this.activeitem = _this.selecteditem;
                            _this.isOpen = true;
                        }
                        else if (_this.activeitem == null) {
                            if (_this.items.length != 0) {
                                _this.activeitem = _this.items[_this.items.length - 1];
                            }
                        }
                        else {
                            if (_this.items.indexOf(_this.activeitem) > -1) {
                                if (_this.items.indexOf(_this.activeitem) == 0) {
                                    _this.activeitem = _this.items[_this.items.length - 1];
                                }
                                else {
                                    _this.activeitem = _this.items[_this.items.indexOf(_this.activeitem) - 1];
                                }
                            }
                            else {
                                if (_this.items.length == 0) {
                                    _this.activeitem = null;
                                }
                                else {
                                    _this.activeitem = _this.items[_this.items.length - 1];
                                }
                            }
                        }
                        break;
                    case 40:// down
                        if (!_this.isOpen) {
                            _this.activeitem = _this.selecteditem;
                            _this.isOpen = true;
                        }
                        else if (_this.activeitem == null) {
                            if (_this.items.length != 0) {
                                _this.activeitem = _this.items[0];
                            }
                        }
                        else {
                            if (_this.items.indexOf(_this.activeitem) > -1) {
                                if (_this.items.indexOf(_this.activeitem) == _this.items.length - 1) {
                                    _this.activeitem = _this.items[0];
                                }
                                else {
                                    _this.activeitem = _this.items[_this.items.indexOf(_this.activeitem) + 1];
                                }
                            }
                            else {
                                if (_this.items.length == 0) {
                                    _this.activeitem = null;
                                }
                                else {
                                    _this.activeitem = _this.items[0];
                                }
                            }
                        }
                        break;
                    case 13:
                        _this.itemClicked(_this.activeitem);
                        break;
                    default:
                        _this.$timeout(function () {
                            _this.$http.post(_this.url, { text: _this.text, count: _this.count }).then(function (result) {
                                _this.items = result.data;
                            }).then(function () {
                                _this.isOpen = true;
                            });
                        }, 5);
                }
            };
            this.closePopup = function () {
                _this.isOpen = false;
            };
            this.itemClicked = function (item) {
                _this.text = item.text;
                _this.isOpen = false;
                _this.selecteditem = item;
                _this.itemSelected(item);
            };
        }
        Autocomplete.tagname = "autocomplete";
        Autocomplete.options = {
            controller: Autocomplete,
            templateUrl: "/components/autocomplete",
            bindings: {
                url: '<',
                count: '<',
                placeholder: '<',
                itemSelected: '&'
            }
        };
        Autocomplete.$inject = ["$http", "$timeout"];
        return Autocomplete;
    }());
    Components.Autocomplete = Autocomplete;
    angular.module("Components", [])
        /*.config(function ($httpProvider) {
            $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded';
            $httpProvider.defaults.headers.post['Content-Type'] =  'application/x-www-form-urlencoded';
        })*/
        /*.config(function ($httpProvider) {
            $httpProvider.defaults.headers.put['Access-Control-Allow-Origin'] = '*';
            $httpProvider.defaults.headers.post['Access-Control-Allow-Origin'] =  '*';
        })*/
        .component(Autocomplete.tagname, Autocomplete.options);
})(Components || (Components = {}));