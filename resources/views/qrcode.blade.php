<!DOCTYPE html>
<html>
<head>
    <title>Generate QR Code</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4">Generate QR Code</h1>
        <form id="qrForm" class="space-y-4">
            <div>
                <label for="text" class="block text-sm font-medium text-gray-700">Text for QR Code</label>
                <input type="text" id="text" name="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required placeholder="e.g., https://laravel.com">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Generate</button>
        </form>
        <div id="qrCodeContainer" class="mt-6 hidden">
            <h2 class="text-lg font-semibold mb-2">Your QR Code:</h2>
            {{-- Set the initial src to empty to avoid a broken image icon --}}
            <img id="qrImage" src="" alt="Generated QR Code" class="mx-auto">
        </div>
    </div>

    <script>
        document.getElementById('qrForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const text = document.getElementById('text').value;
            const qrImage = document.getElementById('qrImage');
            const qrContainer = document.getElementById('qrCodeContainer');

            // Show a loading state if you want
            qrImage.src = ''; // Clear previous image
            qrContainer.classList.add('hidden');

            try {
                const response = await fetch('/api/generate-qrcode', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ text }),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok.');
                }

                const data = await response.json();

                if (data.qr_code) {
                    // This is the key part: set the src to the received data URI
                    qrImage.src = data.qr_code;
                    qrContainer.classList.remove('hidden');
                }
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
                alert('Failed to generate QR code.');
            }
        });
    </script>
</body>
</html>
