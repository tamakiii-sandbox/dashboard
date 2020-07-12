.PHONY: help clean

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies \
	vendor

dependencies:
	type composer > /dev/null

vendor:
	composer install

clean:
	rm -rf vendor
