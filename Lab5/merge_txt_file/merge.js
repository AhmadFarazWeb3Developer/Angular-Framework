const http = require("http");
const fs = require("fs").promises;

http
  .createServer(async function (req, res) {
    try {
    
      const [data1, data2, data3] = await Promise.all([
        fs.readFile("./merge_txt_file/file1.txt", "utf-8"),
        fs.readFile("./merge_txt_file/file2.txt", "utf-8"),
        fs.readFile("./merge_txt_file/file3.txt", "utf-8"),
      ]);

      res.writeHead(200, { "Content-Type": "text/html" });
      res.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>File Contents</title>
          <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
          <style>
            body {
              background-color: #0f172a; 
              color: white;
              font-family: 'Inter', sans-serif;
            }
            .container {
              max-width: 800px;
              margin: 40px auto;
              padding: 20px;
              background: #1e293b;
              border-radius: 10px;
              box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.1);
              font-family: 'Nunito', sans-serif;
            }
            .content {
              background-color: #334155;
              color: white;
              padding: 15px;
              border-radius: 8px;
              overflow-wrap: break-word;
              word-wrap: break-word;
              white-space: pre-wrap;
              border: 1px solid rgba(255, 255, 255, 0.2);
              font-family: 'Nunito', sans-serif;
            }
          </style>
        </head>
        <body class="flex items-center justify-center min-h-screen">
          <div class="container">
            <h1 class="text-3xl font-bold text-center mb-6">📜 File Contents</h1>
            <div class="mb-6">
              <h2 class="text-lg font-semibold mb-2 text-yellow-400">📄 File 1</h2>
              <pre class="content">${data1}</pre>
            </div>
            <div class="mb-6">
              <h2 class="text-lg font-semibold mb-2 text-green-400">📄 File 2</h2>
              <pre class="content">${data2}</pre>
            </div>
            <div>
              <h2 class="text-lg font-semibold mb-2 text-blue-400">📄 File 3</h2>
              <pre class="content">${data3}</pre>
            </div>
          </div>
        </body>
        </html>
      `);
      res.end();
    } catch (error) {
      res.writeHead(500, { "Content-Type": "text/plain" });
      res.write("Error reading files");
      res.end();
    }
  })
  .listen(8080, () => console.log("Server running on port 8080"));
