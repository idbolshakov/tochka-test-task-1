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

