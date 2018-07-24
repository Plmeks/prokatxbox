var app = angular.module('app', ['angularUtils.directives.dirPagination']);
var adminApp = angular.module('AdminApp', []);

/*app.filter('br', function () {
    return function(text){
        text = String(text).trim();
        return (text.length > 0 ? text.replace(/[\r\n]+/g, '<br>') : "");
    }
});*/

app.factory("cartService", function(){
    var smallCartScope;
    var bigCartScope;
    return {
        getSmallCartScope: function () {
            return smallCartScope;
        },
        getBigCartScope: function () {
            return bigCartScope;
        },
        setSmallCartScope: function (value) {
            smallCartScope = value;
        },
        setBigCartScope: function(value) {
            bigCartScope = value;
        },
        smallCartAdd: function (value) {
            smallCartScope.cartItems.push(value);
        },
        bigCartRemove: function() {

        },
        smallCartRemove: function(idProduct) {
            smallCartScope.delete(idProduct);
        }
    };
});

function formatPrice(price) {
    return price.reverse().replace(/((?:\d{2})\d)/g, '$1 ').reverse();
}