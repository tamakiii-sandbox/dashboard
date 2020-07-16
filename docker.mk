.PHONY: help install dependencies build migrate clean
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

migrate:
	docker-compose up -d mysql
	docker-compose exec mysql timeout 60s env MYSQL_PWD=password bash -c 'until (mysqladmin ping -h 127.0.0.1 2>&1 | grep -q alive;) do echo -n .; sleep 1; done; echo'
	docker-compose run --rm --entrypoint bash flyway -c 'make -C dashboard migrate'
	docker-compose stop mysql

.env:
	echo "TARGET=$(TARGET)" > $@

.PHONY: $(TARGETS)
$(TARGETS):
	$(eval TARGET := $@)

clean:
	rm -f .env
