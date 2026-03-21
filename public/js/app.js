document.getElementById('generate-btn').addEventListener('click', async () => {
    const responseMsg = document.getElementById('response-msg');
    const display = document.getElementById('password-display');
    const container = document.getElementById('result-container');

    const data = {
        action: 'generate',
        length: parseInt(document.getElementById('length').value),
        digits: document.getElementById('digits').checked,
        upper: document.getElementById('upper').checked,
        lower: document.getElementById('lower').checked
    };

    if (responseMsg) {
        responseMsg.innerText = '';
        responseMsg.style.color = 'black';
    }

    if (!data.digits && !data.upper && !data.lower) {
        if (responseMsg) {
            responseMsg.innerText = 'Please select at least one character set!';
            responseMsg.style.color = 'red';
        }
        if (container) container.style.display = 'none'; 
        if (display) display.innerText = '';
        return;
    }

    try {
        const response = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (result.success) {
            if (display) display.innerText = result.password;
            if (container) container.style.display = 'block';
            if (responseMsg) {
                responseMsg.innerText = 'Password generated!';
                responseMsg.style.color = 'green';
            }
        } else {
            if (container) container.style.display = 'none';
            if (responseMsg) {
                responseMsg.innerText = result.message || 'Error occurred';
                responseMsg.style.color = 'red';
            }
        }
    } catch (e) {
        if (responseMsg) {
            responseMsg.innerText = 'Server error or invalid response.';
            responseMsg.style.color = 'red';
        }
    }
});

document.getElementById('copy-btn').addEventListener('click', () => {
    const display = document.getElementById('password-display');
    const password = display ? display.innerText : null;
    const responseMsg = document.getElementById('response-msg');
    
    if (password) {
        navigator.clipboard.writeText(password).then(() => {
            if (responseMsg) {
                responseMsg.innerText = 'Copied to clipboard!';
                responseMsg.style.color = 'blue';
            }
        }).catch(() => {
            if (responseMsg) {
                responseMsg.innerText = 'Copy failed.';
                responseMsg.style.color = 'red';
            }
        });
    }
});