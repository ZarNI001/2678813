<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChirpController extends Controller
{
    public function index(): View
    {
        $chirps = Chirp::with('user')->latest()->get();

        return view('chirps.index', compact('chirps'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->chirps()->create($data);

        return redirect()->route('chirps.index')->with('success', 'Chirp posted.');
    }

    public function update(Request $request, Chirp $chirp): RedirectResponse
    {
        abort_unless($request->user()->is($chirp->user), 403);

        $data = $request->validate([
            'message' => ['required', 'string', 'max:255'],
        ]);

        $chirp->update($data);

        return redirect()->route('chirps.index')->with('success', 'Chirp updated.');
    }

    public function destroy(Request $request, Chirp $chirp): RedirectResponse
    {
        abort_unless($request->user()->is($chirp->user), 403);

        $chirp->delete();

        return redirect()->route('chirps.index')->with('success', 'Chirp deleted.');
    }
}
