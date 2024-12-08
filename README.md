# 🚀 DoaVida - Back-End

## 📄 Sobre o Projeto

O projeto **"DoaVida"** visa conscientizar a população sobre a importância da doação de órgãos e facilitar o cadastro de doadores e receptores interessados no processo.

Desenvolvido por estudantes do curso de **Engenharia de Software da UniEVENGÉLICA**, este projeto é uma aplicação **RESTful API** que oferece funcionalidades essenciais para o cadastro de doadores e receptores, autenticação segura e integração entre os dados dos usuários.

---

## 🛠️ Tecnologias Utilizadas

- **Framework:** Laravel 11.33.2  
- **Banco de Dados:** MySQL  
- **Estrutura da API:** RESTful  
- **Ferramentas:** Composer, MySQL Server

---

## 💾 Pré-requisitos

Antes de iniciar, certifique-se de ter:

- [x] **Composer** instalado (para gerenciar pacotes Laravel).  
- [x] **MySQL Server** configurado e executando localmente ou remotamente.  
- [x] Ambiente de desenvolvimento configurado.

Caso não tenha o Composer, instale-o [aqui](https://getcomposer.org).

---

## 🛠️ Instalação

Siga estes passos para configurar o ambiente local:

### 1. Clone o Repositório
```bash
git clone https://github.com/Necrozzyz/Back-End-Doavida
```
### 2. Instale as Dependências
```bash
cd <NOME_DA_PASTA_DO_PROJETO>
composer install
```

### 3. COnfigure o Banco de Dados
 **3.1 Crie um banco de dados no MySQL**
```sql
CREATE DATABASE doaVida;
```

 **3.2 Copie as variáveis de ambiente para o seu ambiente local:**
```bash
cp .env.example .env
```
 **3.3 Edite o .env com as configurações corretas de conexão:**
 ```plaintext
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=doacao_orgaos
DB_USERNAME=<seu_usuario_mysql>
DB_PASSWORD=<sua_senha_mysql>
```

### 4. Gere a Chave de Aplicação:
```bash
php artisan key:generate
```

### 5. Execute as Migrações:
```bash
php artisan migrate
```

### 6. Popule o banco de Dados Iniciais(Opcional):
```bash
php artisan db:seed
```

### 7. Inicie o Servidor Local
```bash
php artisan serve
```
Acesse pelo navegador em:
**http://localhost:8000**
