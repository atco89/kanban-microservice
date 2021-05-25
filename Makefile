up:
	docker-compose -f ./docker/docker-compose.yaml up -d --build
down:
	docker-compose -f ./docker/docker-compose.yaml down
kill:
	docker container rm -f database
	docker container rm -f webserver
clean:
	docker system prune -a --volumes
package:
	docker exec -it webserver composer require atco89/star-fleet-commander:dev-master
webserver:
	docker exec -it webserver bash
restart:
	docker-compose -f ./docker/docker-compose.yaml restart