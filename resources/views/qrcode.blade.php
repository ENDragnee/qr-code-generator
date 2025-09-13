<!DOCTYPE html>
<html>
<head>
    <title>Generate QR Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4">Generate QR Code</h1>
        <form id="qrForm" class="space-y-4">
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Text for QR Code</label>
                <input type="text" id="text" name="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Generate</button>
        </form>
        <div id="qrCode" class="mt-4 hidden">
            <img id="qrImage" src="" alt="QR Code" class="mx-auto">
        </div>
    </div>

    <script>
        document.getElementById('qrForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const text = document.getElementById('text').value;
            const response = await fetch('/api/generate-qrcode', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ text }),
            });
            const data = await response.json();
            if (data.qr_code) {
                document.getElementById('qrImage').src = data.qr_code;
                document.getElementById('qrCode').classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
