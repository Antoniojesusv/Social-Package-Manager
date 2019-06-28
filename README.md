# Initial Configuration to start working with MaSPack

MaSPack it's a full Social Package Manager for SUMMA in Malaga.

[] = OPTIONAL

{} = OBLIGATORY

## **WARNING** All commands here are for Linux.

## Steps

1. Open a terminal

2. When you stay in the correct folder that you have all your projects -> git clone ssh://git@github.com:Antoniojesusv/Social-Package-Manager.git [ NAME ]

3. run 'chmod -R 777 {PROJECT ROOT FOLDER}' to not have permission problems, this type of permissions is only par development environments never establish these premises in your production environment.

4. At this point, you have all files located in repository, but you need to copy hte env.example to .env -> cp env.example .env

5. Run the containers using -> docker-compose up [ --build ]

6. acces the container: docker exec -it { CONTAINER NAME } /bin/sh -c "[ -e /bin/bash ] && /bin/bash || /bin/sh"

7. once inside the container run: php artisan migrate --seed

8. acces to http://localhost/login and enter the following credentials

- if it is the first time you run 'docker compose up' for this project you must wait for all vendor dependencies to be installed.

User: Antonio.Vazquez@gmail.com
Password: Toor123456

### **BE CAREFUL** IF YOU CHANGE YOUR BRANCH, YOU NEED TO FOLLOW THIS GUIDE AGAIN
