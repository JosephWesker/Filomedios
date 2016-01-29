angular.module("demo").controller("SimpleDemoController", function ($scope) {
    $scope.models = {
        "selected": null,
        "lists": {
            "A": [
                {
                    "label": "Vídeo A1"
                },
                {
                    "label": "Vídeo A2"
                },
                {
                    "label": "Vídeo A3"
                }
            ],
            "B": [
                {
                    "label": "Vídeo B1"
                },
                {
                    "label": "Vídeo B2"
                },
                {
                    "label": "Vídeo B4"
                }
            ]
        }
    };

    // Generate initial model
    for (var i = 1; i <= 3; ++i) {
//        $scope.models.lists.A.push({label: "Item A" + i});
//        $scope.models.lists.B.push({label: "Item B" + i});
    }

    // Model to JSON for demo purpose
    $scope.$watch('models', function (model) {
        $scope.modelAsJson = angular.toJson(model, true);
    }, true);

});
