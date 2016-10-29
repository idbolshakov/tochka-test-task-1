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

