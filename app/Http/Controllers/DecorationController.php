<?php

namespace App\Http\Controllers;

use App\Models\DecorationProject;
use App\Models\DecorationService;
use App\Models\DecorationArticle;
use App\Models\ConsultationRequest;
use Illuminate\Http\Request;

class DecorationController extends Controller
{
    public function index()
    {
        $services = DecorationService::all();
        $projects = DecorationProject::latest()->take(6)->get();
        $articles = DecorationArticle::latest()->take(3)->get();

        return view('decoration.index', compact('services', 'projects', 'articles'));
    }

    public function portfolio()
    {
        $projects = DecorationProject::latest()->paginate(12);
        return view('decoration.portfolio', compact('projects'));
    }

    public function blog()
    {
        $articles = DecorationArticle::latest()->paginate(9);
        return view('decoration.blog', compact('articles'));
    }

    public function article($slug)
    {
        $article = DecorationArticle::where('slug', $slug)->firstOrFail();
        $relatedArticles = DecorationArticle::where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('decoration.article', compact('article', 'relatedArticles'));
    }

    public function requestConsultation(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'project_type' => 'required|string',
            'description' => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'budget_range' => 'required|string'
        ]);

        ConsultationRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Votre demande de consultation a été envoyée avec succès.'
        ]);
    }
} 