PROJECT_NAME = tochka_test_task_1_frontend

BLOCKS = src/blocks/project/exchange-rates\

CSS_BUNDLES := $(foreach block, $(BLOCKS), $(block)/build/bundles/bundle.css)

JS_BUNDLES  := $(foreach block, $(BLOCKS), $(block)/build/bundles/bundle.js)

STATIC      := $(foreach block, $(BLOCKS), $(block)/build/static/*)

TARGETS = clear_build_dir\
		  rebuild_all_blocks\
		  concat_bundle_css\
		  concat_bundle_js\
		  copy_html\
		  minify_css\
		  minify_js\

################################################################################

all: $(TARGETS)
	
	@echo PROJECT \<\<$(PROJECT_NAME)\>\> BUILD COMPLETED;

################################################################################

clear_build_dir:

	@rm -rf build/
	@mkdir -p build/bundles

rebuild_all_blocks:

	@for blockDir in $(BLOCKS); do\
	   	make -sC $${blockDir};\
	done

copy_html:

	@cp src/index.html build/index.html;


concat_bundle_css:

	@echo $(CSS_BUNDLES) | xargs cat > build/bundles/bundle.css 2>/dev/null || true;


concat_bundle_js:

	@echo $(JS_BUNDLES) | xargs cat > build/bundles/bundle.js 2>/dev/null || true;

minify_js:

	@uglifyjs -d module=false build/bundles/bundle.js -c \
		> build/bundles/_bundle.js 2>/dev/null;
	@mv build/bundles/_bundle.js build/bundles/bundle.js;

minify_css:

	@cleancss build/bundles/bundle.css > build/bundles/_bundle.css;
	@mv build/bundles/_bundle.css build/bundles/bundle.css;

