<?php

namespace App\Http\Controllers;

use App\Models\Employer;

class EmployerBaseController extends Controller
{
    public function getEmployer()
    {
        if (!auth()->check()) {
            return null;
        }

        return Employer::where('account_id', auth()->user()->account_id)->first();
    }
}