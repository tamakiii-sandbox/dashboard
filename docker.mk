.PHONY: help install dependencies build clean
.PHONY: install-dev install-debug

TARGET := production-pseudo
TARGETS := production-pseudo development debug

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	.env \
	build

install-dev: development install
install-debug: debug install

dependencies:
	type docker-compose > /dev/null

build:
	docker-compose build

.env:
	echo "TARGET=$(TARGET)" > $@

.PHONY: $(TARGETS)
$(TARGETS):
	$(eval TARGET := $@)

clean:
	rm -f .env
