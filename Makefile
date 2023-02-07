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