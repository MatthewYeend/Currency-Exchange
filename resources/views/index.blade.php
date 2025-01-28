<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Currency Exchange</title>
    </head>
    <body>
        <h1>Currency Exchange Rates</h1>
        <form id="convertForm">
            <input type="number" name="amount" placeholder="Amount" required>
            <input type="text" name="from" placeholder="From Currency (e.g. GBP)" required>
            <input type="text" name="to" placeholder="To Currency (e.g. EUR)" required>
            <button type="submit">Convert</button>
        </form>
        
        <div id="result"></div>

        <script>
            document.getElementById('convertForm').addEventListener('submit', async function(e){
                e.preventDefault();
                const formData = new FormData(e.target);
                const response = await fetch('/currency-exchange/convert', {
                    method: 'POST',
                    body: formData,
                });
                const data = await response.json();
                document.getElementById('result').innerText = 'Convert Amount: ${data.converted_amount}';
            });
        </script>
    </body>
</html>