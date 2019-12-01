FROM node:latest

RUN npm install -g json-server

ADD db.json /data/db.json

WORKDIR /data

EXPOSE 8080

ENTRYPOINT ["json-server"]

CMD ["db.json", "-p", "8080"]
