<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        Event::create([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? 'scheduled',
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Evento creado');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ]);

        $event->update([
            'name' => $validated['name'],
            'date' => $validated['date'],
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'] ?? $event->status,
        ]);

        return redirect()->route('admin.events.index')->with('status', 'Evento actualizado');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('status', 'Evento eliminado');
    }
}