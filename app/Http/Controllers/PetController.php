<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

final class PetController extends Controller
{
    public function index(?array $pet = null): View
    { 
        return view('pet.index', ['pet' => $pet]);
    }

    public function store(Request $request): RedirectResponse
    {
        $response = Http::post('https://petstore.swagger.io/v2/pet', [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'category' => [
                'name' => $request->input('categoryName'),
            ],
            'tags' => $request->input('tags'),
        ]);

        if ($response->successful()) {
            $message = 'Dodawanie powiodło się';
        } else {
            $message = 'Dodawanie nie powiodło się';
        }

        return redirect()->route('pet.index')->with('addStatus', $message);
    }

    public function findById(Request $request): View
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/'.$request->input('petId'));

        if (! $response->successful()) {
            session(['notFound' => 'Nie znaleziono zwierzaka']);
            return view('pet.index', ['pet' => null]);
        } else {
            session()->forget('notFound');
            return view('pet.index', ['pet' => $response->json()]);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $response = Http::delete('https://petstore.swagger.io/v2/pet/'.$request->input('petIdToRemove'));

        if ($response->successful()) {
            $message = 'Usuwanie powiodło się';
        } else {
            $message = 'Usuwanie nie powiodło się';
        }

        return redirect()->route('pet.index')->with('deleteStatus', $message);
    }

    public function edit(Request $request): RedirectResponse
    {
        $response = Http::put('https://petstore.swagger.io/v2/pet/', [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'category' => [
                'name' => $request->input('categoryName'),
            ],
            'tags' => $request->input('tags'),
        ]);

        if ($response->successful()) {
            $message = 'Edycja powiodła się';
        } else {
            $message = 'Edycja nie powiodła się';
        }

        return redirect()->route('pet.index')->with('editStatus', $message);
    }
}
