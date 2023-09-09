<?php

namespace App\Http\Controllers;

use App\Models\File;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRootFolderRequest;

class DocumentsController extends Controller
{
    /**
     * Display documentation page
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Documents/Documents');
    }

        /**
     * Display documentation page
     */
    public function createFolder(StoreRootFolderRequest $request)
    {
        $data = $request->validate();
    }
}
