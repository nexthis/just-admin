<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

class UserControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $query = User::query();
        $query->with('roles');
        $data = $this->advancePaginate($query, function ($paginate){
            $paginate->setCollection( $paginate->getCollection()->makeVisible( ['provider', 'email'] ) );
            $paginate->getCollection()->map(function ($item){
                $item->roles;
            });
        });

        return Inertia::render('user/Index', compact('data'));
    }
}