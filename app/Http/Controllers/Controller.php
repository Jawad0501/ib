<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\Facades\DataTables;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * render datatable tables button group
     *
     * @param  mixed $data
     * @return void
     */
    public function buttonGroup($data)
    {
        return view('backend.datatable-buttons', compact('data'));
    }

    /**
     * datatableInitilize
     *
     * @param  mixed $model
     * @return \Yajra\DataTables\EloquentDatatable
     */
    public function datatableInitilize($model)
    {
        return DataTables::eloquent($model)->addIndexColumn();
    }

    /**
     * render view
     *
     * @param  mixed $page
     * @param  mixed $data
     * @return void
     */
    public function render($page, $data = [])
    {
        return view($page, $data);
    }
}
