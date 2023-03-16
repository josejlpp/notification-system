FROM node:lts-alpine

# instala um servidor http simples para servir conteúdo estático
RUN npm install -g http-server

# faz da pasta 'app' o diretório atual de trabalho
WORKDIR /app

EXPOSE 8080
CMD [ "http-server", "dist" ]