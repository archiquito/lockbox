# LockBox

LockBox é um projeto PHP para gerenciamento seguro de notas criptografadas, utilizando PostgreSQL e Docker.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)
- [PHP 8+](https://www.php.net/downloads.php)
- Navegador web
- **Opcional:** [Herd](https://herd.dev/) para rodar o PHP localmente de forma simples

## Tecnologias utilizadas

- [Tailwind CSS](https://tailwindcss.com/) para estilização rápida e responsiva
- [DaisyUI](https://daisyui.com/) para componentes UI prontos e integração com Tailwind

## Instalação

1. **Clone o repositório:**

   ```sh
   git clone https://github.com/seu-usuario/lockbox.git
   cd lockbox
   ```

2. **Configure o banco de dados:**

   - Edite o arquivo `config/config.php` se necessário.
   - O padrão já está configurado para usar Docker com PostgreSQL.

3. **Configure as variáveis de ambiente (.env):**

   Crie ou edite o arquivo `.env` na raiz do projeto com as chaves de criptografia:

   ```
   ENCRYPT_FIRST_KEY="sua_primeira_chave"
   ENCRYPT_SECOND_KEY="sua_segunda_chave"
   ```
- **Modelo:** veja o exmeplo no.env.template.

   Essas chaves são usadas para criptografar e descriptografar as notas. Não compartilhe suas chaves em ambientes públicos.

4. **Suba o banco de dados com Docker Compose:**

   ```sh
   docker-compose up -d
   ```

   Isso irá criar e iniciar o container do PostgreSQL.

5. **Instale as dependências do projeto (se houver):**
   ```sh
   composer install
   ```

## Como rodar o projeto

### Usando o servidor embutido do PHP

1. **Inicie o servidor embutido do PHP:**

   ```sh
   php -S localhost:8888 -t public/
   ```

2. **Acesse no navegador:**
   ```
   http://localhost:8888
   ```

### Usando o Herd (opcional)

1. **Instale o Herd:**  
   Siga as instruções em [herd.dev](https://herd.dev/).

2. **Inicie o projeto com Herd:**  
   Basta abrir a pasta do projeto no Herd e acessar o endereço informado pelo aplicativo.

## Observações

- Certifique-se de que o container do banco de dados está rodando antes de acessar o sistema.
- As credenciais do banco estão em `config/config.php` e devem coincidir com as do `docker-compose.yml`.
- As chaves de criptografia devem estar corretamente configuradas no arquivo `.env`.
- Para parar o banco de dados:
  ```sh
  docker-compose down
  ```

## Licença

Este projeto é distribuído sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
