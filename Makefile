all: init

init:
	@echo ">>>>> Starting system"
	docker-compose up -d
	docker-compose exec web npm run build


build:
	@echo ">>>>> Build System"
	docker-compose up -d
	@echo ">>>>> Build Api"
	docker run --rm -v $(pwd)/backend:/app composer:2.3 composer install
	docker-compose exec php-fpm php artisan migrate --seed
	docker-compose exec php-fpm php artisan key:generate
	@echo ">>>>> Build Web"
	docker-compose exec web npm install
	docker-compose exec web npm run build

composer-install:
	docker run --rm -v $(pwd)/backend:/app composer:2.3 composer install
