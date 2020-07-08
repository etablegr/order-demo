const mysql = require('mysql2/promise');



exports.handler = async event => {
    let connection_id = event.requestContext.connectionId;
    let sql = "DELETE FROM websocket_connections WHERE connection_id = ?";

    const dbconnection = await mysql.createConnection({
        host: process.env.DB_HOST,
        user: process.env.DB_USER,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_NAME,
    });

    let response = { statusCode: 200, body: 'Connected.' };

    try {
        await dbconnection.execute(sql, [connection_id]);
    } catch(err) {
        // console.log output is written into cloudwatch logs.
        console.log('Failed to remove from database', err.toString());
        response = { statusCode: 500, body: 'Failed To Connect' };
    } finally {
        dbconnection.end();
    }

    return response;
}