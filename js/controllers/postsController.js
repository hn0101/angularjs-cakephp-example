/* global app */

app.controller('postsController', ['$scope', 'Post', 'Category',
    function($scope, Post, Category) {
        
        $scope.posts = Post.query();
        $scope.post = null;
        $scope.categories = Category.query();
        $scope.isEditing = false;
        
        $scope.save = function() {
            var p = new Post($scope.post);
            p.$save($scope.refresh);
        };

        $scope.edit = function(post) {
            if (post !== undefined) {
                $scope.post = post;                
            }
            $scope.isEditing = true;
            window.scrollTo(0,0);
        };
        
        $scope.editCancel = function() {
            $scope.refresh();
        };
        
        $scope.refresh = function() {
            $scope.posts = Post.query();
            $scope.post = null;
            $scope.isEditing = false;
        };
        
        $scope.delete = function(post) {
            var p = new Post(post);
            p.$remove({id: post.Post.id}, $scope.refresh);
        };
    }
]);