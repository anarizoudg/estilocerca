<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EstablishmentController extends Controller
{
    public function edit(Request $request): View
    {
        $establishment = $request->user()->establishment;

        return view(
            'establishment.edit',
            compact('establishment')
        );
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'category' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'opening_time' => ['nullable', 'date_format:H:i'],
            'closing_time' => ['nullable', 'date_format:H:i'],
        ]);

        $request->user()
            ->establishment()
            ->updateOrCreate([], $validated);

        return redirect()
            ->route('establishment.edit')
            ->with(
                'success',
                'La información del establecimiento se guardó correctamente.'
            );
    }
}
