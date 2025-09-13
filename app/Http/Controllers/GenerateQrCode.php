<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\Image\Svg;
use BaconQrCode\Writer;
use Illuminate\Http\Request;

class GenerateQrCode extends Controller
{
    public function generate(Request $request)
    {
        // Validate the input
        $request->validate([
            'text' => 'required|string|max:255',
        ]);

        // Create a PNG renderer
        $renderer = new Svg();
        $renderer->setHeight(256);
        $renderer->setWidth(256);

        // Create a writer instance
        $writer = new Writer($renderer);

        // Generate QR code with the provided data
        $data = $request->input('text');
        $qrCode = $writer->writeString($data);

        // Return the QR code as an image response
        return response()->json(['qr_code' => 'data:image/svg;base64,' . base64_encode($qrCode)]);
    }
}


