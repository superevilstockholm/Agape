<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;

use App\Models\News;

class NewsController extends Controller
{
    private function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (
            News::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $limit = $request->query('limit', 10);
            $query = News::with('user:id,name');
            $allowedTypes = ['title', 'content', 'slug'];
            if ($request->has('type') && $request->has('search') && in_array($request->type, $allowedTypes)) {
                $query->where($request->type, 'like', '%' . $request->search . '%');
            }
            if ($limit === 'all') {
                $news = $query->get();
            } else {
                $news = $query->paginate((int)$limit);
            }
            return response()->json([
                'status' => true,
                'message' => 'successfully get news list',
                'data' => $news,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'user_id' => 'required|exists:users,id',
                'slug' => 'nullable|string|max:255',
            ]);
            if (empty($validated['slug'])) {
                $validated['slug'] = $this->generateSlug($validated['title']);
            }
            $news = News::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'successfully create news',
                'data' => $news->load('user:id,name')
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): JsonResponse
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'successfully get detail news',
                'data' => $news->load('user:id,name'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => 'sometimes|string|max:255',
                'content' => 'sometimes|string',
                'user_id' => 'sometimes|exists:users,id',
                'slug' => 'nullable|string|max:255',
            ]);
            if (array_key_exists('title', $validated) && empty($validated['slug'])) {
                $validated['slug'] = $this->generateSlug($validated['title'], $news->id);
            }
            $news->update($validated);
            return response()->json([
                'status' => true,
                'message' => 'successfully update news',
                'data' => $news->load('user:id,name')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        try {
            $news->delete();
            return response()->json([
                'status' => true,
                'message' => 'successfully delete news',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
