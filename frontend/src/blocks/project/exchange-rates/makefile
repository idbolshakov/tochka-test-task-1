###############################################################################
#                              BLOCK MAKEFILE                                  #
################################################################################

################################################################################
# VAR
################################################################################

PROJECT = tochka_test_task_1_frontend 

BLOCK   = exchange-rates

CSS     = src/exchange-rates.css\
		  src/__currency/exchange-rates__currency.css\
		  src/__currency/_USD/exchange-rates__currency_USD.css\
		  src/__currency/_EUR/exchange-rates__currency_EUR.css\

JS      = src/exchange-rates.js/config.js\
          src/exchange-rates.js/model.js\
          src/exchange-rates.js/view.js\
          src/exchange-rates.js/controller.js\
          src/exchange-rates.js/exchange-rates.js\

TARGETS = delete_old_files\
		  css_merge\
		  js_merge\

################################################################################
# ALL
################################################################################

all: $(TARGETS)
	@echo $(PROJECT) :: $(BLOCK) block build completed

################################################################################
# TARGETS
################################################################################

delete_old_files:

	@rm -rf build/
	@rm -rf example/static/

css_merge: 

	@mkdir -p build/bundles

	@cat $(CSS) > build/bundles/bundle.css


js_merge: 

	@mkdir -p build/bundles

	@cat $(JS) > build/bundles/bundle.js

