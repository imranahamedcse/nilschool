<?php

namespace Database\Seeders;

use App\Models\Upload;
use Illuminate\Database\Seeder;

class UploadSeeder extends Seeder
{
    public function run()
    {
        Upload::create([
            'path'              => 'backend/uploads/users/user-icon-1.png',
        ]);
        Upload::create([
            'path'              => 'backend/uploads/users/user-icon-2.png',
        ]);
        Upload::create([
            'path'              => 'backend/uploads/users/user-icon-3.png',
        ]);
        Upload::create([
            'path'              => 'backend/uploads/users/user-icon-4.png',
        ]);
    }
}
