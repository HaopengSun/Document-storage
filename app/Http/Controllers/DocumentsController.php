<?php

namespace App\Http\Controllers;

use App\Models\File;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreFolderRequest;

class DocumentsController extends Controller
{
    /**
     * Display documentation page
     */
    public function index(Request $request): Response
    {
        $files = $this->getUserFiles();
        return Inertia::render('Documents/Documents', compact('files'));
    }

    /**
     * Display documentation page
     */
    public function createFolder(StoreFolderRequest $request)
    {
        $data = $request->validated();
        $parent = $request->parent;

        if (!$parent) {
            $parent = $this->getRoot();
        }

        $file = new File();
        $file->is_folder = 1;
        $file->name = $data['name'];

        $parent->appendNode($file);
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
     * Return whether the user has already created root folder
     */
    public function returnRootFolderOfUser()
    {
        return response()->json([
          'root_folder' => $this->returnWhetherRootIsCreated(),
      ]);
    }

    /**
     * Return whether user created root folder before
     */
    private function returnWhetherRootIsCreated()
    {
        return !empty($this->getRoot(Auth::id()));
    }

    /**
     * Return user's root folder
     */
    private function getRoot()
    {
        return File::query()->whereIsRoot()->where('created_by', Auth::id())->firstOrFail();
    }

    /**
     * Return folders and files based on the parent/root folder
     */
    private function getUserFiles()
    {
        $folder = $this->getRoot();
        return File::query()
          ->where('parent_id', $folder->id)
          ->where('created_by', Auth::id())
          ->orderBy('is_folder', 'desc')
          ->orderBy('created_at', 'desc')
          ->paginate(10);
    }
}
