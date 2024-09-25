
# To Do List

Aplicação simples para gerenciamento de tarefas


## Autores

- [@motive-mobi](https://www.github.com/motive-mobi)


## Referências

 - [Laravel](https://laravel.com/docs)
 - [VueJS](https://vuejs.org/)
 - [MariaDB (docker)](https://hub.docker.com/_/mariadb)
## 🔗 Contatos
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/alexandre-tucunduva)


## Stack utilizada

**Front-end:** VueJs 2, NodeJS 18.17.1, npm 10.8.0

**Back-end:** PHP 8.2.23, Composer 2.5.5, Laravel 11.9, MariaDB 11.6.1, Docker 27.2.0


## Deploy

Para fazer o deploy desse projeto:

1. Prepare o container com o MariaDB
1.1 Siga as referências em https://hub.docker.com/_/mariadb

1.2 Crie um banco de dados e um usuário com permissões para o novo banco


2. API
2.1 Clone o repositório
```bash
  git clone git@github.com:motive-mobi/to-do-list.git
```

2.2 Acesse a pasta da api
```bash
  cd to-do-list-api
```

2.3 Instale as dependências do Laravel via composer
```bash
  composer install
```

2.4 Configure o arquivo .env com as informações de host, usuário, senha e banco de dados (de acordo com o que foi criado no passo 1)

2.5 Rode as migrations
```bash
  php artisan migrate
```

2.6 Rode a aplicação
```bash
  php artisan serve
```

As rotas da api estão disponíveis no endereço http://localhost:8000

3. FRONTEND
3.1 Acesse a pasta do frontend
```bash
  cd to-do-list-app
```

3.2 Instale as dependências do VueJS
```bash
  npm install
```

3.3 Rode o servidor de desenvolvimento
```bash
  npm run dev
```

A aplicação está disponível no endereço  http://localhost:5173