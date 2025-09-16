<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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

            $allowedTypes = ['title', 'content', 'slug', 'author'];

            if ($request->has('type') && $request->has('search') && in_array($request->type, $allowedTypes)) {
                if ($request->type === 'author') {
                    $query->whereHas('user', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
                } else {
                    $query->where($request->type, 'like', '%' . $request->search . '%');
                }
            }
            $news = ($limit === 'all') ? $query->get() : $query->paginate((int)$limit);
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_id' => 'required|exists:users,id',
                'slug' => 'nullable|string|max:255',
            ]);
            if (empty($validated['slug'])) {
                $validated['slug'] = $this->generateSlug($validated['title']);
            }
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('news', 'public');
                $validated['image_path'] = $path;
            }
            $news = News::create($validated);
            return response()->json([
                'status' => true,
                'message' => 'successfully created news',
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
    public function show(int $id): JsonResponse
    {
        try {
            $news = News::with('user:id,name')->where('id', $id)->firstOrFail();
            return response()->json([
                'status' => true,
                'message' => 'Successfully get news detail',
                'data' => $news,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'News not found',
            ], 404);
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
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'user_id' => 'sometimes|exists:users,id',
                'slug' => 'nullable|string|max:255',
            ]);
            if ($request->filled('title') && !$request->filled('slug')) {
                $validated['slug'] = $this->generateSlug($validated['title'], $news->id);
            }
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('news', 'public');
                $validated['image_path'] = $path;
                if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                    Storage::disk('public')->delete($news->image_path);
                }
            }
            $news->update($validated);
            return response()->json([
                'status' => true,
                'message' => 'Successfully updated news',
                'data' => $news->refresh()->load('user:id,name'),
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
            if ($news->image_path && Storage::disk('public')->exists($news->image_path)) {
                Storage::disk('public')->delete($news->image_path);
            }
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
