
(function(app) {

    var _requestURL = app.ExchangeRates.config.requestURL;
    var _view = null;

    var registerView = function(view) {

        _view = view;
    }

    var getExchangeRates = function() {

        var request = new XMLHttpRequest();
        request.open('GET', _requestURL, true);
        request.send();

        request.onreadystatechange = function() {

            if (request.readyState === 4 && request.status === 200) {

                _view.render(JSON.parse(request.response));
            };
        };
    };

    //
    // EXPORT 
    //
    app.ExchangeRates.model = {

        registerView: registerView,
        getExchangeRates: getExchangeRates
    };

})(APP);


