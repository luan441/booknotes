args=

all: help

help: ## Prints help for targets with comments
	@cat $(MAKEFILE_LIST) | grep -E '^[a-zA-Z_-]+:.*?## .*$$' | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

composer: ## Run composer cli
	docker compose run php composer ${args}

up: ## Up project
	docker compose up -d

down: ## Down project
	docker compose down

console: ## Run console symfony
	@docker compose run php ./bin/console ${args}

fix-permission:
	sudo chmod -R a+rw .
