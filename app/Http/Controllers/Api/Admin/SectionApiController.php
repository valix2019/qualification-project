<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

/**
 * Class SectionApiController
 *
 * @package App\Http\Controllers\Api\Admin
 */
class SectionApiController extends AdminApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(
            __('crud.indexed'),
            Section::with(['parent', 'children'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SectionRequest  $request
     *
     * @return JsonResponse
     */
    public function store(SectionRequest $request): JsonResponse
    {
        try {
            $section = Section::create($request->only(['parent_id', 'is_active', 'title', 'description', 'order']));

            return $this->success(__('crud.stored'), $section, 201);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
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
        return $this->success(__('crud.shown'), $section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SectionRequest  $request
     * @param  Section  $section
     *
     * @return JsonResponse
     */
    public function update(SectionRequest $request, Section $section): JsonResponse
    {
        try {
            $section->update($request->only(['parent_id', 'is_active', 'title', 'description', 'order']));

            return $this->success(__('crud.updated'), $section);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Section  $section
     *
     * @return JsonResponse
     */
    public function destroy(Section $section): JsonResponse
    {
        try {
            $section->delete();

            return $this->success(__('crud.destroyed'));
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Вывести список ресурса в виде дерева
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function tree (Request $request): JsonResponse
    {
        $tree = Section::query()
            ->whereNull('parent_id')
            ->with(['tree'])
            ->get();

        return $this->success(__('crud.indexed'), $this->makeHierarchy($tree, $request->get('except')));
    }

    /**
     * Сформировать иерархию
     *
     * @param  Collection  $tree
     * @param  int|null  $except
     * @param  int  $level
     *
     * @return array
     */
    private function makeHierarchy (Collection $tree, ?int $except = null, int $level = 0): array
    {
        $result = [];

        foreach ($tree as $node) {
            if (!is_null($except) && $node->id === $except)
                continue;

            $prefix = '';

            for ($i = 0; $i < $level; $i++) {
                $prefix .= '-';
            }

            if (!empty($prefix))
                $prefix .= ' ';

            $result[] = [
                'value' => $node->id,
                'text' => $prefix . $node->title,
            ];

            $result = array_merge($result, $this->makeHierarchy($node->tree, $except, $level + 1));
        }

        return $result;
    }
}
