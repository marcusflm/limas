## Exemplo sistema gestão de vendas

- Clone esse repositório, abra no VSCODE utilizando a extensão "Dev  Containers" e aguarde.
- Crie um arquivo na raiz do repositório chamado `.env` a partir de `.example.env`.
- No terminal do VSCODE:
```bash
composer install

php artisan key:generate

yarn install

php artisan migrate:fresh --seed

yarn dev
```

- **Aplicação:** Veja em http://localhost:8017