<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Model
{
    use HasFactory;

    public function toStorage($data){

        $f = $data['file'];
        $path = 'public/'.$data["destination"].'_files/';
        $file_name = time().'.pdf';
        $file = str_replace(' ', '+', str_replace('data:application/pdf;base64,', '', $f));
        Storage::disk('local')->put($path.$file_name, base64_decode($file));

        return $file_name;

    }
    
}
