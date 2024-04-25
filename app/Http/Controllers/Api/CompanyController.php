<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function get()
    {
        $company = Company::find(1);
        return response()->json([
            'code' => 200,
            'success' => true,
            'message' => 'Get company success',
            'data' => $company
        ]);
    }
}
