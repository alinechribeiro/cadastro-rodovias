# Projeto de Gerenciamento de Trechos

Este é um projeto de gerenciamento de trechos de rodovias, desenvolvido utilizando Laravel no backend e Vue.js com Inertia.js no frontend. O projeto permite o cadastro, edição, visualização e exclusão de trechos, além de exibir mapas interativos com dados GeoJSON utilizando a biblioteca Leaflet.

## Requisitos

Antes de começar, certifique-se de que você tenha as seguintes ferramentas instaladas em sua máquina:

- **PHP >= 8.0**
- **Composer**
- **Node.js >= 14.x** (com NPM ou Yarn)
- **MySQL** ou outro banco de dados compatível

## Instalação

Siga os passos abaixo para configurar o projeto localmente:

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/alinechribeiro/cadastro-rodovias.git
   cd cadastro-rodovias
    ```
## Instale as dependências do PHP:

```bash
composer install
```

## Instale as dependências do Node.js:

Se você estiver usando npm:

```bash
npm install
```
Ou, se estiver usando Yarn:

```bash
yarn install
```

## Configure o arquivo .env:

Copie o arquivo .env.example para .env:

```bash
cp .env.example .env
```

## Edite o arquivo .env para configurar o banco de dados e outras variáveis de ambiente conforme necessário.

## Gere a chave da aplicação:

```bash
php artisan key:generate
```


## Execute as migrações do banco de dados:

```bash
    php artisan migrate
```

## Como Rodar o Projeto
### Rodando o Servidor de Desenvolvimento

Inicie o servidor de desenvolvimento do Laravel:

```bash
php artisan serve
```

Compile os assets do frontend:

Se você estiver usando npm:

```bash
npm run dev
```

Ou, se estiver usando Yarn:

```bash
    yarn dev
```

Isso irá iniciar o Vite para compilar e servir os arquivos Vue.js em modo de desenvolvimento.

## Acessando o Projeto

Após iniciar o servidor de desenvolvimento, você pode acessar o projeto através do navegador em:

http://127.0.0.1:8000

## Executando Testes

Para executar os testes, use o comando:

```bash
php artisan test
```

Certifique-se de que o ambiente de testes esteja configurado corretamente no arquivo .env.testing.

## Estrutura do Projeto

    Backend: Laravel
    Frontend: Vue.js 3, Inertia.js, Leaflet
    Banco de Dados: MySQL (ou outro banco de dados compatível)
    Gerenciador de Dependências do PHP: Composer
    Gerenciador de Dependências do Node.js: NPM ou Yarn

## Contribuição

Contribuições são bem-vindas! Se você encontrar algum problema ou tiver sugestões, por favor, abra uma issue ou envie um pull request.
