# estudos-backend-projeto-003
Pacote para cache

```shell
# rodando comandos composer
docker run --rm --interactive --tty  --volume $PWD:/app composer [comando]

# rodando phpunit
docker run -it --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-cli vendor/bin/phpunit

```