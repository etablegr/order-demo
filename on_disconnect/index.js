const mysql = require('mysql');

const dbconnection = mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME,
});

exports.handler = async event => {
    let connection_id = event.requestContext.connectionId;
    let sql = "DELETE FROM websocket_connections WHERE connection_id = ?";

    dbconnection.connect();

    try {
        await dbconnection.query(sql, [connection_id]);
    } catch(err) {
        // console.log output is written into cloudwatch logs.
        console.log('Failed to store into database', err.toString());
        return {statusCode: 500, body: 'Failed To Connect'}
    }

    dbconnection.end();
    return { statusCode: 200, body: 'Connected.' };
}