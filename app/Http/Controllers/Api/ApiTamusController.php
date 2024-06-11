<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKbliPerusahaanRequest;
use App\Http\Requests\UpdateKbliPerusahaanRequest;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\KbliPerusahaanResource;
use App\Http\Resources\KbliPerusahaanSearchResource;
use App\Http\Resources\KbliSearchResource;

class ApiTamusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
