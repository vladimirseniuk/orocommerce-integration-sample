# OroCommerce Integration Example

## JSON Server

Build image from Dockerfile and run container:

```bash
cd ./json-server

docker build -t json-server .

docker run --rm -it --name json-server --network="host" json-server
```