<?php

namespace App\Http\Controllers\Api;


use App\Models\Section;
use Illuminate\Http\JsonResponse;

class SectionApiController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $sections = Section::active()
            ->whereNull('parent_id')
            ->with(['children'])
            ->get();

        return $this->success(__('crud.indexed'), $sections);
    }

    /**
     * Display the specified resource.
     *
     * @param  Section  $section
     *
     * @return JsonResponse
     */
    public function show(Section $section): JsonResponse
    {
        if ($section->getAttribute('is_active')) {
            return $this->success(__('crud.shown'), $section->load(['children', 'tasks']));
        } else {
            return $this->error(__('crud.not_found'), 404);
        }
    }
}
