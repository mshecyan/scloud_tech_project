up:
	docker compose up --build

down:
	docker compose down --remove-orphans

pg-dump:
	docker exec -it postgresdb bash -c "pg_dump -U postgres scloud > /var/local/dbdump.sql"

pg-from-dump:
	docker exec -it postgresdb bash -c "psql -U postgres -d scloud < /var/local/dbdump.sql"