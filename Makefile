.PHONY: help
.DEFAULT_GOAL := help
SHELL ?= /bin/bash

MAKEFILE_PATH := $(abspath $(lastword $(MAKEFILE_LIST)))
COMPOSE_EXEC ?= docker-compose exec

# Prefix any command that should be run within the fpm docker container with $(EXEC_FPM)
EXEC_PHP ?= $(COMPOSE_EXEC) php
ifeq (, $(shell which docker-compose))
	EXEC_PHP =
endif

help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

.PHONY: bash
bash: ## Starts a bash session in the php container
	$(COMPOSE_EXEC) php /bin/sh

.PHONY: pre-commit
pre-commit:
	$(EXEC_PHP) vendor/bin/php-cs-fixer fix --allow-risky=yes src
	$(EXEC_PHP) vendor/bin/phpstan analyse src
	$(EXEC_PHP) vendor/bin/phpunit tests

.PHONY: tests
tests:
	$(EXEC_PHP) vendor/bin/phpunit tests