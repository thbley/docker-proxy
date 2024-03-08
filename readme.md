docker build -t redistest .

# no timeout, no cpu limit, constant connect time
docker run --rm -it --network host --name redis -d redis:7.2-alpine
sleep 5
time docker run --rm -it --network host -v$(pwd):/var/www redistest php test.php
docker stop redis

# runs into timeout, docker proxy takes 100% cpu
docker run --rm -it --name redis -d -p 6379:6379 redis:7.2-alpine
sleep 5
time docker run --rm -it --network host -v$(pwd):/var/www redistest php test.php
docker stop redis
