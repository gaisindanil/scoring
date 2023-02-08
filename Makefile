start:
	docker-compose up -d

build:
	docker-compose build --pull

down:
	docker-compose down --remove-orphans

lint:
	docker-compose run --rm backend_php_cli vendor/bin/psalm

migrations-diff:
	docker-compose run --rm backend_php_cli php bin/console doctrine:migrations:diff

migrations-migrate:
	docker-compose run --rm backend_php_cli php bin/console doctrine:migrations:migrate

fixtures-education:
	docker-compose run --rm backend_php_cli php bin/console doctrine:fixtures:load --append --group=education

fixtures-operator:
	docker-compose run --rm backend_php_cli php bin/console doctrine:fixtures:load --append --group=operator

app-client-scoring:
	docker-compose run --rm backend_php_cli php bin/console app:client:scoring $(id)

unit-test:
	docker-compose run --rm backend_php_cli php bin/phpunit