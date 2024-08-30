# Dockerfile per Frontend
FROM node:18-alpine

# Impostare la directory di lavoro
WORKDIR /app

# Copiare il contenuto del frontend
COPY . .

RUN apt install npm

# Installare i pacchetti (se usi un task runner come Gulp/Grunt)
RUN npm install

# Esporre la porta del server di sviluppo
EXPOSE 3000

CMD ["npm", "start"]
