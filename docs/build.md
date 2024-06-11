# Сборка и запуск

В проекте поднимаются следующие сервисы:
- **blog** - Основное приложение
- **proxy** - Прокси-сервер на nginx
- **db** - База данных на движке PostgreSQL

> Описание сервисов в [docker-compose.yml](../docker-compose.yml)

> Образ самого приложение в [Dockerfile](../Dockerfile)

> Конфигурация прокси-сервера в [nginx.conf](../nginx.conf)

- Нужно прокинуть локальный домен в /etc/hosts для доступа к приложению, домен прописан в самом конфиге `nginx.conf`

```shell
sudo vi /etc/hosts
```

```text
127.0.0.1 blog.localhost
```

> Все команды прописаны в [Makefile](../Makefile)
- Сборка проекта:

```shell
make build
```

- Запуск проекта
```shell
make up
```

- Сборка и запуск
```shell
make build-and-up
```
