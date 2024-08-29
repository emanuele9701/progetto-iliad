## Istruzioni per l'uso

### Prerequisiti
- Docker
- Docker Compose

### Setup
1. Clonare il repository:
   ```bash
   git clone <repository-url>
   cd my-project
   ```

2. Costruire e avviare i container Docker:
   ```bash
   docker-compose up --build
   ```

3. Accedere al frontend su `http://localhost:3000` e al backend su `http://localhost:9000`.

### Esecuzione dei Test
- Per eseguire i test del backend, usa:
  ```bash
  docker-compose exec backend php artisan test
