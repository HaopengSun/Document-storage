<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRootFolderRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

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
