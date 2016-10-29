var APP = APP || {};

APP.ExchangeRates = {

    model: {},
    view: {},
    controller: {},

    config: {

        // адрес сервиса для запроса
        requestURL: 'index.php'
    }
};


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


(function(app) {

    var container = document.getElementById('exchange-rates'); 

    container.innerHTML = "loading..";

    var render = function(data) {

        container.innerHTML = '' 
            +'<div '
                +'title="курс доллара (USD) к рублю"'
                +'id="exchange-rates__currency_USD"'
                +'class="exchange-rates__currency exchange-rates__currency_USD"'
                +'>'+data.USD.toFixed(2)
            +'</div>'

            +'<div '
                +'title="курс евро (EUR) к рублю"'
                +'id="exchange-rates__currency_EUR"'
                +'class="exchange-rates__currency exchange-rates__currency_EUR"'
                +'>'+data.EUR.toFixed(2)
            +'</div>';
    }

    //
    // EXPORT
    //
    app.ExchangeRates.view = {

        render: render
    }

})(APP);

(function(app) {

    var model = app.ExchangeRates.model;

    var onLoad = function() {

        model.getExchangeRates();
    }

    //
    // EXPORT 
    //
    app.ExchangeRates.controller = {

        onLoad: onLoad
    };

})(APP);

(function(app) {

    var model      = app.ExchangeRates.model;
    var view       = app.ExchangeRates.view;
    var controller = app.ExchangeRates.controller;

    model.registerView(view);

    window.addEventListener('load', function() {
        
        controller.onLoad();
    });

    
})(APP);

