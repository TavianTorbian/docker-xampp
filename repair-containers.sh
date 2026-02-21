#!/usr/bin/env bash
docker system prune -a -f
docker-compose down
docker run --rm -v $(pwd)/mariadb_data:/data alpine rm /data/tc.log
./setup-mariadb.sh
