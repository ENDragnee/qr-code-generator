<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class GenerateQrCode extends Controller
{
    public function generate(Request $request)
    {
        // Validate the input
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        $data = $request->input('text');

        // The default format is an SVG string, which is great for scalability.
        $qrCodeSvg = QRCode::generate($data);

        // Construct the full data URI for the SVG.
        // The correct MIME type for SVG is 'image/svg+xml'.
        $qrCodeDataUri = 'data:image/svg+xml;base64,' . base64_encode($qrCodeSvg);

        // Return the data URI in a JSON response
        return response()->json(['qr_code' => $qrCodeDataUri]);
    }
}
