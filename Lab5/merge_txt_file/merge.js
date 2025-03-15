const http = require("http");
const fs = require("fs").promises;
const url = require("url");
const path = require("path");

const FILES_DIR = "./merge_txt_file"; // Directory to store text files

// Helper function to handle file operations
async function handleFileOperation(
  fileName,
  content = null,
  operation = "read"
) {
  const filePath = path.join(FILES_DIR, fileName);

  try {
    switch (operation) {
      case "create":
      case "update":
        await fs.writeFile(filePath, content);
        return `File ${fileName} ${operation === "create" ? "created" : "updated"}`;
      case "delete":
        await fs.unlink(filePath);
        return `File ${fileName} deleted`;
      case "read":
        return await fs.readFile(filePath, "utf-8");
      default:
        throw new Error("Invalid operation");
    }
  } catch (error) {
    throw new Error(`Error during ${operation} operation: ${error.message}`);
  }
}

http
  .createServer(async function (req, res) {
    const parsedUrl = url.parse(req.url, true);
    const { pathname, query } = parsedUrl;

    try {
      if (req.method === "GET" && pathname === "/") {
        // Read and display files
        const [data1, data2, data3] = await Promise.all([
          handleFileOperation("file1.txt"),
          handleFileOperation("file2.txt"),
          handleFileOperation("file3.txt"),
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
      } else if (req.method === "POST" && pathname === "/create") {
        // Create a new file
        const { fileName, content } = query;
        const result = await handleFileOperation(fileName, content, "create");
        res.writeHead(200, { "Content-Type": "text/plain" });
        res.write(result);
        res.end();
      } else if (req.method === "PUT" && pathname === "/update") {
        // Update an existing file
        const { fileName, content } = query;
        const result = await handleFileOperation(fileName, content, "update");
        res.writeHead(200, { "Content-Type": "text/plain" });
        res.write(result);
        res.end();
      } else if (req.method === "DELETE" && pathname === "/delete") {
        // Delete a file
        const { fileName } = query;
        const result = await handleFileOperation(fileName, null, "delete");
        res.writeHead(200, { "Content-Type": "text/plain" });
        res.write(result);
        res.end();
      } else {
        res.writeHead(404, { "Content-Type": "text/plain" });
        res.write("Not Found");
        res.end();
      }
    } catch (error) {
      res.writeHead(500, { "Content-Type": "text/plain" });
      res.write(error.message);
      res.end();
    }
  })
  .listen(8080, () => console.log("Server running on port 8080"));
