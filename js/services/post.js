/* global services */

services.factory('Post', ['$resource',
    function($resource) {
        return $resource('/api/posts/:id', {}, {
            query: {method: 'GET', isArray: true},
            save: {method: 'POST'},
            remove: {method: 'DELETE'}
        });
    }
]);