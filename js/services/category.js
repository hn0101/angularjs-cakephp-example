/* global services */

services.factory('Category', ['$resource',
    function($resource) {
        return $resource('/api/categories/:id', {}, {
            query: {method: 'GET', isArray: true}
        });
    }
]);