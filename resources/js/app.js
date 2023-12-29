import "./bootstrap";

const http = require("http");

const hostname = "127.0.0.1";
const port = 3000;

const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader("Content-Type", "text / plain");
    res.end("Xin chào từ NodeJS  n");
});

server.listen(port, "127.0.0.1", () => {
    console.log("Máy chủ đang chạy tại http: // $ {hostname}: $ {port} /");
});
