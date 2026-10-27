<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Establishment;

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

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $establishments = Establishment::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    $subquery
                        ->whereRaw(
                            'LOWER(name) LIKE LOWER(?)',
                            ['%' . $search . '%']
                        )
                        ->orWhereRaw(
                            'LOWER(category) LIKE LOWER(?)',
                            ['%' . $search . '%']
                        );
                });
            })
            ->orderBy('name')
            ->get();

        return view(
            'establishments.index',
            compact('establishments', 'search')
        );
    }

    public function show(int $establishment): View
    {
        $establishment = Establishment::with('services')
            ->findOrFail($establishment);

        return view(
            'establishments.show',
            compact('establishment')
        );
    }
}
