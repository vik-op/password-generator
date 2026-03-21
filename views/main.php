<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Password Generator</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; padding-top: 50px; background: #f4f4f4; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 350px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .checkbox-group { display: flex; flex-direction: column; gap: 5px; }
        button { width: 100%; padding: 10px; cursor: pointer; background: #007bff; color: white; border: none; border-radius: 4px; }
        #result-container { margin-top: 20px; padding: 10px; border: 1px dashed #ccc; display: none; text-align: center; }
        #password-display { font-weight: bold; font-size: 1.2em; word-break: break-all; }
        .copy-btn { margin-top: 10px; background: #28a745; font-size: 0.8em; }
        #response-msg { color: green; font-size: 0.9em; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Type numbers of symbols</h2>
        <div class="form-group">
            <label for="length">Length (1-32):</label>
            <input type="number" id="length" min="1" max="32" value="8">
        </div>
        
        <div class="form-group checkbox-group">
            <label><input type="checkbox" id="digits" checked> Numbers without 0 and 1</label>
            <label><input type="checkbox" id="upper" checked> Big letters without o and O</label>
            <label><input type="checkbox" id="lower" checked> Small letters without "l"</label>
        </div>

        <button id="generate-btn">Generate</button>

        <div id="result-container" style="display: none;">
            <div id="password-display"></div>
            <button id="copy-btn" class="copy-btn">Copy to Clipboard</button>
        </div>
        <p id="response-msg"></p>
    </div>

    <script src="js/app.js"></script>
</body>
</html>