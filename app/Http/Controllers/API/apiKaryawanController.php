<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\BagianResource;
use App\Http\Resources\KaryawanCollectionResource;
use App\Http\Resources\KaryawanResource;
use App\Models\bagianModel;
use App\Models\karyawanModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class apiKaryawanController extends BaseController
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {

        $karyawan = karyawanModel::all();
        return $this->sendResponse(KaryawanResource::collection($karyawan), 'Karyawan retrieved successfully.');
    }
    public function show($id): JsonResponse
    {
        $karyawan = karyawanModel::find($id);
        if (is_null($karyawan)) {
            return $this->sendError('Karyawan not found.');
        }
        return $this->sendResponse(new KaryawanResource($karyawan), 'Karyawan retrieved successfully.');
    }

    public function Bagian($id): JsonResponse
    {
        $bagian = bagianModel::with(['karyawan'])->find($id);
        if (is_null($bagian)) {
            return $this->sendError('Karyawan not found.');
        }
        return $this->sendResponse(new BagianResource($bagian), 'Bagian retrieved successfully.');
        // return $this->sendResponse(new KaryawanCollectionResource($karyawan), 'Karyawan retrieved successfully.');
    }
}
