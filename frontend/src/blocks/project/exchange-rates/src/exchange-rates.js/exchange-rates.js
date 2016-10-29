(function(app) {

    var model      = app.ExchangeRates.model;
    var view       = app.ExchangeRates.view;
    var controller = app.ExchangeRates.controller;

    model.registerView(view);

    window.addEventListener('load', function() {
        
        controller.onLoad();
    });

    
})(APP);

