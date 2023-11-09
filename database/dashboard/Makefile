.PHONY: help install dependencies clean
.PHONY: info validate migrate

export FLYWAY_LOCATIONS := filesystem:$(realpath ./sql)

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies

dependencies:
	type flyway > /dev/null

info:
	flyway info

validate:
	flyway validate

migrate:
	flyway migrate

clean:
