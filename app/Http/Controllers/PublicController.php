<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class PublicController extends Controller
{
    public function welcome()
    {
        $advertisements = Advertisement::query()
            ->where('is_accepted', true)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('welcome', compact('advertisements'));
    }

    public function searchAdvertisements(Request $request)
    {
        // codice iniziale

        // dd($request->all());
        // $query = $request->input('query');
        // $advertisements = Advertisement::search($query)->where('is_accepted', true)->paginate(10);
        // return view('advertisement.searched', ['advertisements' => $advertisements, 'query' => $query]);

        $searchTerm = $request->input('query');
        if (! $searchTerm) {
            return back()->withErrors(['generico' => __('ui.emptySearch')]);
        }

        $searchField = $request->input('field', 'all');
        if (! in_array($searchField, ['all', 'title', 'description', 'category'], true)) {
            $searchField = 'all';
        }

        if ($searchField === 'category') {
            $categoryIds = Category::query()
                ->get(['id', 'name'])
                ->filter(function (Category $category) use ($searchTerm): bool {
                    if (Str::contains($category->name, $searchTerm, true)) {
                        return true;
                    }

                    foreach (['it', 'en', 'es'] as $locale) {
                        $translationKey = 'ui.'.$category->name;

                        if (Lang::has($translationKey, $locale)
                            && Str::contains(__($translationKey, [], $locale), $searchTerm, true)) {
                            return true;
                        }
                    }

                    return false;
                })
                ->modelKeys();

            $advertisements = Advertisement::query()
                ->with(['images', 'category'])
                ->where('is_accepted', true)
                ->whereIn('category_id', $categoryIds)
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            return view('advertisement.searched', [
                'advertisements' => $advertisements,
                'query' => $searchTerm,
                'searchField' => $searchField,
            ]);
        }

        if ($searchField === 'title' || $searchField === 'description') {
            $scoutQuery = Advertisement::search($searchTerm, function ($tnt, $searchQuery) {
                return $tnt->search($searchQuery);
            });
        } else {
            $scoutQuery = Advertisement::search($searchTerm);
        }

        $matchedAdvertisements = $scoutQuery->get();

        if ($searchField !== 'all') {
            $matchedAdvertisements = $matchedAdvertisements->filter(function (Advertisement $advertisement) use ($searchField, $searchTerm): bool {
                return str_contains(
                    strtolower($advertisement->{$searchField}),
                    strtolower($searchTerm)
                );
            });
        }

        $advertisements = Advertisement::query()
            ->with(['images', 'category'])
            ->where('is_accepted', true)
            ->whereIn('id', $matchedAdvertisements->modelKeys())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('advertisement.searched', [
            'advertisements' => $advertisements,
            'query' => $searchTerm,
            'searchField' => $searchField,
        ]);
    }

    public function setLanguage(string $lang): RedirectResponse
    {
        abort_unless(in_array($lang, ['it', 'en', 'es'], true), 404);

        session()->put('locale', $lang);

        return redirect()->back();
    }
}
