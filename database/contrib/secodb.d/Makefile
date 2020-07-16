.PHONY: help install dependencies clean

TARGETS := $(foreach f,$(wildcard *.sql),$f~)

HOST := mysql
USER := root
DATABASE := dashboard
PASSWORD := password

help:
	@cat $(firstword $(MAKEFILE_LIST))

install: \
	dependencies

dependencies:
	type mysql > /dev/null

migrate: $(TARGETS)

$(TARGETS):
	mysql -h $(HOST) -u $(USER) -p$(PASSWORD) $(DATABASE) < $(subst ~,,$@) > $@

clean:
