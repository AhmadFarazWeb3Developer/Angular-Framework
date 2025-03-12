var http = require("http");
var fs = require("fs");

http
  .createServer(function (req, res) {
    fs.readFile("fsd-2025.txt", "utf8", function (err, data) {
      if (err) {
        res.writeHead(500, { "Content-Type": "text/plain" });
        res.write("Error reading file");
        return res.end();
      }
      res.writeHead(200, { "Content-Type": "text/html" });
      res.write(`
                        <!DOCTYPE html>
                        <html>
                        <head>
                                <title>Beautified Text File</title>
                                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                                <style>
                                        body {
                                                background-color: rgb(11, 22, 38); 
                                                color: white;
                                        }
                                        .content {
                                                background-color: rgb(48, 76, 100); 
                                                color: white;
                                                max-width: 80%; 
                                                margin: 0 auto; 
                                                overflow-wrap: break-word; 
                                                word-wrap: break-word; 
                                                white-space: pre-wrap; 
                                                overflow-x: hidden; 
                                        }
                                </style>
                        </head>
                        <body class="font-sans m-5 w-full">
                                <h1 class="text-2xl font-bold mb-4 w-full">Content of fsd-2025.txt</h1>
                                <pre class="content p-4 border border-gray-500 rounded">${data}</pre>
                        </body>
                        </html>
                `);
      return res.end();
    });
  })
  .listen(8080);
