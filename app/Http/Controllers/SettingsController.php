<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $settings = $user->settings ?? [
            'email_notifications' => true,
            'profile_visibility' => false,
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email_notifications' => ['boolean'],
            'profile_visibility' => ['boolean'],
        ]);

        $user = Auth::user();
        
        // If you have a settings table/model
        // $user->settings()->update($validated);
        
        // Or if you're storing settings as JSON in the users table
        $user->update([
            'settings' => $validated
        ]);

        return back()->with('success', 'Paramètres mis à jour avec succès');
    }
} 