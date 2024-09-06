<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Modules\Shop\Repositories\Front\Interface\AddressRepositoryInterface;

class ProfileController extends Controller
{

  protected $addressRepository;

  public function __construct(AddressRepositoryInterface $addressRepository)
  {
    $this->addressRepository = $addressRepository;
  }
  public function index()
  {
    $user = Auth::user();
    $this->data['addresses'] = $this->addressRepository->findByUser($user);
    $this->data['users'] = $user;
    
    return $this->loadTheme('profiles.index', $this->data);
  }

  public function edit(Request $request)
  {
    $user = Auth::user();
    $this->data['users'] = $user;
    $this->data['addresses'] = $this->addressRepository->findByUser($user);

    return $this->loadTheme('profiles.edit', $this->data);
  }

  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());
    $request->user()->save();

    return Redirect::route('profile.index')->with('success', 'Profile telah diperbarui.');
  }
}
