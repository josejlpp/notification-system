all: init

init:
	@echo ">>>>> Starting system"
	@docker-compose up -d

build:
	@echo ">>>>> Build system"
	@docker-compose up -d /
	&& docker-compose exec php-fpm composer install /
	&& docker-compose exec php-fpm php artisan migrate --seed /
	&& docker-compose exec php-fpm php artisan key:generate
