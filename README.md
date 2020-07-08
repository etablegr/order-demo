# Websocket Demo example
A simple websocket demonstration using Websocket AWS Api Gateway.

## Parts

The project is consisted by theese parts:

* `on_connect`: Lambda that stores the connection id into a mnyswl table websocket_connections. It is executed once a client connect into the api gateway.
* `on_disconnect`: Lambda that removes the connection id into a mnyswl table websocket_connections. It is executed once a client disconnect into the api gateway. Keep in mind it may not be executed always as documentation says.
* `client`: A web client that listends on websocket's sent messages.
* `sendorder`: An endpoint using php that notifies the clients for a new order.

In order for the demo to work you will need:

* A mariadb/mysql database to be **both** accessible via lambdas and wia the `sendorder` php scripts.
* IAM credentials
* An websocket Api Gateway.

## Running `sendorder`

1. Make and deploy an Database instance, then initialize the `websocket_connections` table using `database.sql`.
2. Deploy lambdas as senn above.
3. Initialize a websocket api.
4. Copy `.env.dist` into `.env`.
5. Fill `.env` with the appropriate values.
6. Run `composer install`.
7. Run `docker-compose up -d`.

In order to notify the clients for a new order run:

```
curl -X POST -d "order_item=Ταχινόπιτα&quantity=4" http://0.0.0.0:8980
```

## Deploying lambdas:

In order to deploy the lambdas run the following steps:

1. Zip the contents of `on_connect` into a zip file.
2. Zip the contents of `on_disconnect` into a seperate zip file.
3. Create 2 lambdas on aws console.
4. Upload the zip files to aws lambdas.
5. Place the following environmental variables on both lambdas as the following table describes:

ENVIRONMENTAL VARIABLE | DESCRIPTION
--- | ---
`DB_HOST`     | Database Hostname
`DB_USER`     | Database User
`DB_PASSWORD` | Database Password
`DB_NAME`     | Database name

## Running the client

1. On `client/websocket.js` replace with the correct websocket url.
2. If not, run `docker-compose up -d`.
3. Visit: `http://0.0.0.0:8981`.