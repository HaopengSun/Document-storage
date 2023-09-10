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

    /**
     * Create root folder
     */
    public function createRootFolder()
    {
        $file = new File();
        $file->name = Auth::user()->email;
        $file->is_folder = 1;
        $file->makeRoot()->save();

        return response()->json([
          'success' => true,
          'error message' => '',
      ]);
    }

    /**
     * Create root folder
     */
    public function returnRootFolderOfUser()
    {
        return response()->json([
          'root_folder' => $this->returnWhetherRootIsCreated(Auth::id()),
      ]);
    }

    /**
     * Return whether user created root folder before
     */
    private function returnWhetherRootIsCreated($user_id)
    {
        return !empty($this->getRoot($user_id));
    }

    /**
     * Return user's root folder
     */
    private function getRoot($user_id)
    {
        return File::query()->whereIsRoot()->where('created_by', $user_id)->firstOrFail();
    }
}
