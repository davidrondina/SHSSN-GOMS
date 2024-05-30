<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentSignatory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SignatorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signature_image = public_path('images/deped-logo.png');
        $image_content = file_get_contents($signature_image);
        $file_name = 'IMG_' . uniqid() . '.png';
        Storage::disk('public')->put('uploads/images/document-signatory/' . $file_name, $image_content);

        DocumentSignatory::create([
            'signature_image' => 'uploads/images/document-signatory/' . $file_name,
            'name' => 'Ismael T. Santos, LPT',
            'position' => 'Guidance Counselor/Master Teacher II',
            'type' => 'Good Moral'
        ]);
    }
}
