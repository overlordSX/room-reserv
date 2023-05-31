<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;

class ClientController extends Controller
{
    //todo можно добавить страничку клиентов

    public function store(ClientRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $client = Client::query()->create([
            'family' => $validated['family'],
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
        ]);

        return redirect(route('dashboard'));
    }
}
