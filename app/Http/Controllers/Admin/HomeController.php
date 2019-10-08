<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

use App\Excels\CourseExport;

class HomeController extends BaseController
{
    public function index( )
    {
        return Excel::download(new CourseExport, 'course.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
}