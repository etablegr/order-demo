const mysql = require('mysql2/promise');

exports.handler = async (event,context,callback) => {

    // Api Gateway connection identifier
    let connection_id = event.requestContext.connectionId;

    const dbconnection = await mysql.createConnection({
        host: process.env.DB_HOST,
        user: process.env.DB_USER,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_NAME,
    });

    let sql = "INSERT INTO websocket_connections (connection_id) VALUES (?)";
    let response = { statusCode: 200, body: 'Connected.' };

    try {
       await dbconnection.execute(sql, [connection_id]);
    } catch (err) {
        console.log('Failed to store into database', err.toString());
        response = { statusCode: 500, body: 'Failed To Connect' };
    } finally {
        dbconnection.end();
    }

    return response;
}