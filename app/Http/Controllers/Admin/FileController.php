<?php

namespace App\Http\Controllers\Admin;

use App\Models\File;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        $data = $this->advancePaginate(File::query());
        return Inertia::render('file/Index', $data);
    }

    public function store(Request $request): bool
    {
        \FileTool::file($request->file('file'))
            ->model(null)
            ->make();
        $request->dd();
        return true;
    }
}
