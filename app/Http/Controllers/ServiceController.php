<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit')
                ->with(
                    'error',
                    'Primero debes registrar tu establecimiento para administrar servicios.'
                );
        }

        $services = $establishment->services()
            ->orderBy('name')
            ->get();

        return view(
            'services.index',
            compact('establishment', 'services')
        );
    }

    public function create(Request $request): View|RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit')
                ->with(
                    'error',
                    'Primero debes registrar tu establecimiento para agregar servicios.'
                );
        }

        return view(
            'services.create',
            compact('establishment')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit')
                ->with(
                    'error',
                    'Primero debes registrar tu establecimiento.'
                );
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $establishment->services()->create($validated);

        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'El servicio se registró correctamente.'
            );
    }

    public function edit(Request $request, int $service): View|RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit')
                ->with(
                    'error',
                    'Primero debes registrar tu establecimiento.'
                );
        }

        $service = $establishment->services()
            ->findOrFail($service);

        return view(
            'services.edit',
            compact('establishment', 'service')
        );
    }

    public function update(Request $request, int $service): RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit')
                ->with(
                    'error',
                    'Primero debes registrar tu establecimiento.'
                );
        }

        $service = $establishment->services()
            ->findOrFail($service);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'price' => ['nullable', 'numeric', 'min:0'],
        ]);

        $service->update($validated);

        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'El servicio se actualizó correctamente.'
            );
    }

    public function destroy(Request $request, int $service): RedirectResponse
    {
        $establishment = $request->user()->establishment;

        if (!$establishment) {
            return redirect()
                ->route('establishment.edit');
        }

        $service = $establishment->services()
            ->findOrFail($service);

        $service->delete();

        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'El servicio se eliminó correctamente.'
            );
    }
}
