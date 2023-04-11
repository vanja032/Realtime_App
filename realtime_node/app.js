const express = require("express");
const { v4 : uuidv4 } = require("uuid");
const mysql = require("mysql");
require("dotenv").config();

const app = express();
const appPort = process.env.APP_PORT || 3000;

let connection = mysql.createConnection({
    host: process.env.MYSQL_HOST,
    user: process.env.MYSQL_USER,
    password: process.env.MYSQL_PASSWORD,
    database: process.env.MYSQL_DATABASE,
});

const server = app.listen(`${appPort}`, () => {
    connection.connect();
});

const socket = require("socket.io")( server, {
    cors : { origin: "*"}
});

socket.on("connection", (sock) => {
    console.log("New client connected.");

    sock.on("order", (data) => {
        //console.log("Item #" + data["itemId"]);

        let order = {
            order_code : uuidv4(),
            item_id : data["itemId"],
            created_at : mysql.raw("CURRENT_TIMESTAMP()"),
            updated_at : mysql.raw("CURRENT_TIMESTAMP()")
        };

        connection.query("INSERT INTO orders SET ?", order, (error, result) => {
            if(error) throw error;
            console.log("Order placed successfully.");
            console.log("Result => " + JSON.stringify(result));
            socket.emit("order_processing", {
                order : {
                    order_code : order.order_code
                }
            });
            socket.emit("order_success", {
                message : "Order successfully placed.",
                order_code : order.order_code
            });
        });
    });

    sock.on("disconnect", () => {
        console.log("The client has been disconnected.");
    });
});