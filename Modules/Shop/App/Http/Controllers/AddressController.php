<?php

namespace Modules\Shop\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Modules\Shop\App\Models\Address;
use Illuminate\Http\RedirectResponse;
use Modules\Shop\Repositories\Front\Interface\AddressRepositoryInterface;

class AddressController extends Controller
{

  protected $addressRepository;

  public function __construct(AddressRepositoryInterface $addressRepository)
  {
    $this->addressRepository = $addressRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('shop::index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('shop::create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): RedirectResponse
  {
    //
  }

  /**
   * Show the specified resource.
   */
  public function show($id)
  {
    return view('shop::show');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Request $request)
  {
    $address = $this->getAddress();

    $provinces = $address['province']['rajaongkir']['results'];
    $cities = $address['city']['rajaongkir']['results'];
    // dd($cities);

    // $this->data = [
    //   'provinces' => $provinces,
    //   'cities' => $cities,
    // ];
    // $addressID = $this->addressRepository->findByID($request->get('address_id'));
    $addressUser = $this->addressRepository->findByUser(Auth::user());
    $userAddress = $addressUser;
    // dd($userAddress);
    return $this->loadTheme('addresses.edit', ['provinces' => $provinces, 'cities' => $cities, 'addresses' => $userAddress]);
    
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id): RedirectResponse
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    //
  }

  private function getAddress()
  {
    $province = [];
    $city = [];
    try {
      $responseProvince = Http::withHeaders([
        'key' => env('API_ONGKIR_KEY'),
      ])->get(env('API_ONGKIR_BASE_URL_PROVINCE'));
      $province = json_decode($responseProvince->getBody(), true);

      $responseCity = Http::withHeaders([
        'key' => env('API_ONGKIR_KEY'),
      ])->get(env('API_ONGKIR_BASE_URL_CITY'));
      $city = json_decode($responseCity->getBody(), true);

      // $address = $response['rajaongkir']['results'];
    } catch (\Exception $e) {
      return $e;
    }
    $this->data = [
      'province' => $province,
      'city' => $city,
    ];
    
    return $this->data;
  }
}
