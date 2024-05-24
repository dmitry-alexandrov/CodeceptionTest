runTest:
	docker exec -it selenium-app ./vendor/bin/codecept run

runAdminTest:
	docker exec -it selenium-app ./vendor/bin/codecept run -g admin
runFederalTest:
	docker exec -it selenium-app ./vendor/bin/codecept run -g federal
runRegionalTest:
	docker exec -it selenium-app ./vendor/bin/codecept run -g regional
runMunicipalTest:
	docker exec -it selenium-app ./vendor/bin/codecept -g muinicipal
runAllGroup:
	docker exec -it selenium-app ./vendor/bin/codecept run -g admin -g federal -g regional -g muinicipal

# dockers commands
start:
	docker-compose up -d --force-recreate
stop:
	docker-compose down
ls:
	docker-compose ls
connect:
	docker exec -it selenium-app bash

# other
stats:
	docker stats
logs:
	docker-compose logs
logsf:
	docker-compose logs -f
