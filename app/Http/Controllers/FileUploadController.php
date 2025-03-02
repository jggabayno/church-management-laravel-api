<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;

class FileUploadController extends Controller
{
    public function index(Request $request)
    {
        return FileUpload::toStorage($request->all());
    }
}
