<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdCategoriesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create()
    {
        $v = TRUE;
        return $v
                ? Response::allow()
                : Response::deny('You do not have permission to add new category!');
    }
}
