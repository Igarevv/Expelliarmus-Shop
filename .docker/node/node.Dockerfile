FROM node:18-alpine

WORKDIR /var/www/expelliarmus/frontend

RUN mkdir -p .npm && \
    npm config set cache /var/www/expelliarmus/frontend/.npm --global