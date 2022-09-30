# Installation

## Creating test environment

1) In docker_compose branch there are a Dockerfile and apache conf files. They must be downloaded in the same directory
   where yml file will be created.
2) Create a docker-compose.yml file with the following content and replace the curly brackets content with the desired
   configuration.

``` sh
version: '3'
services:
  webserver:
    container_name: {{container_name}}
    ports:
      - "{{secure_port}}:443"
      - "{{non_secure_port}}:80"
    build:
      context: .
```

Any other configuration can be added, e.g.: a volume

3) In yml file location create and start the container.

``` sh
docker-compose -p {{project_name}} up -d
```

Again, replace text in curly brackets for desired name

## Getting the project ready

1) Enter to the container.

``` sh
docker exec -ti {{container_name}} bash
```

2) Move to html location.

``` sh
cd /var/www/html
```

3) Clone the repository.

``` sh
git clone {{repo_url}} .
```

4) Install dependencies with composer.

``` sh
composer install
```

5) Add write permissions to storage folder and subfolders. The webserver will create and edit files in there.

```sh
chown -R www-data:www-data storage
chmod -R 755 storage
```

## Usage

1) Open browser and enter to the url defined in container creation

> e.g. https://localhost:{{secure_port}}

2) Register as user, login and use