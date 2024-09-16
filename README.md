# Task ⌚

#### ☕ Tecnologias utilizadas:

- Laravel 11 (PHP 8.2)
- Tailwind CSS
- Vite

---

#### ⚙️ Passo a passo

- composer update
- npm install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- npm run build

Editar o `.env` para apontar para a aplicação `APP_URL=http://127.0.0.1:8000`   
Alterar o `SESSION_DRIVER=database` para `SESSION_DRIVER=file`   

Adicionar conexão com banco de dados   
`DB_CONNECTION=mysql`   
`DB_HOST=127.0.0.1`   
`DB_PORT=3306`   
`DB_DATABASE=database`   
`DB_USERNAME=user`   
`DB_PASSWORD=password`   

