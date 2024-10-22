# Doc4You - Sistema de Agendamento de Consultas Médicas

> Um sistema web simples para agendamento de consultas, desenvolvido com PHP e Laravel.

## Descrição

O Doc4You facilita o agendamento de consultas médicas, conectando pacientes e médicos de forma eficiente. O sistema permite que pacientes encontrem médicos por especialidade, visualizem seus horários disponíveis e agendem consultas online. Médicos podem gerenciar seus horários, visualizar suas consultas agendadas e manter seus dados atualizados. Pacientes menores de 12 anos são automaticamente direcionados para médicos pediatras.

## Funcionalidades

**Para Pacientes:**

- Cadastro e autenticação.
- Busca de médicos por especialidade.
- Agendamento de consultas online.
- Visualização e gerenciamento de consultas agendadas.
- Edição de dados cadastrais.
- Exclusão de conta.

**Para Médicos:**

- Cadastro e autenticação.
- Visualização de consultas agendadas.
- Edição de dados cadastrais.
- Exclusão de conta.

## Instalação

1. **Clone o repositório:**
    ```bash
    git clone https://github.com/Rweiber/Doc4you.git
    ```

2. **Entre no diretório do projeto:**
    ```bash
    cd Doc4you
    ```

3. **Instale as dependências:**
    ```bash
    composer install
    ```

4. **Crie o arquivo `.env` a partir do exemplo:**
    ```bash
    cp .env.example .env
    ```

5. **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

6. **Configure o banco de dados no arquivo `.env`:**

    No arquivo `.env`, atualize as configurações de conexão ao banco de dados:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=doc4you
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

7. **Execute as migrations para criar as tabelas no banco de dados:**
    ```bash
    php artisan migrate
    ```

8. **Execute os seeders para popular o banco com dados iniciais:**
    ```bash
    php artisan db:seed
    ```

9. **Inicie o servidor de desenvolvimento:**
    ```bash
    php artisan serve
    ```

10. **Acesse a aplicação:**

    Abra o navegador e vá para `http://localhost:8000` para acessar o Doc4You.

## Como Usar

### Paciente:

1. **Cadastro:** 
   Ao acessar a aplicação, o paciente pode se registrar clicando em "Registrar-se". Após o cadastro, o paciente pode fazer login usando seu e-mail e senha.

2. **Agendar Consulta:**
   Após o login, o paciente pode buscar médicos por especialidade e visualizar os horários disponíveis. Pacientes menores de 12 anos só podem visualizar médicos da especialidade Pediatria.

3. **Gerenciar Consultas:**
   O paciente pode visualizar suas consultas agendadas no dashboard e ter a opção de editar a data ou cancelar a consulta, se necessário.

### Médico:

1. **Cadastro:** 
   O médico pode se registrar na plataforma utilizando seu CRM e dados de cadastro.

2. **Visualizar Consultas:**
   Após o login, o médico pode visualizar todas as consultas agendadas com ele, organizadas por data e hora.

## Tecnologias Utilizadas

- PHP 8
- Laravel 11
- Bootstrap 5
- MySQL

## Contribuições

Contribuições são bem-vindas! Se você tiver alguma sugestão ou encontrar um problema, sinta-se à vontade para abrir uma issue ou enviar um pull request.

