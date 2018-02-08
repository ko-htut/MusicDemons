<input type="text" class="form-control" ng-model="$ctrl.text" ng-keyup="$ctrl.showSuggestions($event)" ng-keypress="$ctrl.showSuggestions($event)" placeholder="@{{ $ctrl.placeholder }}">
<ul class="typeahead dropdown-menu" style="left: auto; width:calc(100% - 30px); display:block;" ng-if="$ctrl.isOpen" click-outside="$ctrl.closePopup()" click-outside-exclusion="..>input" ng-mouseleave="$ctrl.activeitem = null">
    <li class="disabled" ng-if="$ctrl.items.length == 0">
        <a href="#"><strong>Geen resultaten</strong></a>
    </li>
    <li ng-repeat="item in $ctrl.items" ng-click="$ctrl.itemClicked(item)" ng-mouseenter="$ctrl.activeitem = item" ng-class="{ 'active': $ctrl.activeitem == item }">
        <a href="#"><strong>@{{ item.text }}</strong></a>
    </li>
</ul>