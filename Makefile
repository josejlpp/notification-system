all: init

init:
	@echo ">>>>> Starting system"
	docker-compose up -d
	docker-compose exec web npm run build


build:
	@echo ">>>>> Build Api"
	docker run --rm -v $(shell pwd)/backend:/app composer:2.3 composer install
	cp $(shell pwd)/backend/.env.example $(shell pwd)/backend/.env
	touch $(shell pwd)/backend/database/database.sqlite
	docker-compose up -d
	docker-compose exec php-fpm php artisan key:generate
	docker-compose exec php-fpm php artisan migrate --seed
	docker-compose restart queue
	@echo ">>>>> Build Web"
	docker-compose exec web npm install
	docker-compose exec web npm run build
	@echo ">>>>> Finished build, have fun =D"

composer-install:
	docker run --rm -v $(shell pwd)/backend:/app composer:2.3 composer install
