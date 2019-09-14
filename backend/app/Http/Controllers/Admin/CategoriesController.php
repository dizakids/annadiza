<?php

namespace App\Http\Controllers\Admin;

use App\Business\Posts\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use http\Env\Request;

class CategoriesController extends Controller
{
    public function tree()
    {
        $tree = Category::defaultOrder()->withDepth()->get()->toTree();
        return $tree;
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $category = !$request->id ? new Category(): Category::findOrFail($request->id);
        $parent = Category::findOrFail($request->parentId);

        $category->fill($request->all());
        if (!$request->id || $category->parent_id !== $request->parentId) {
            $parent->appendNode($category);
        } else {
            $category->save();
        }
    }

    public function removeCategory(Category $cat)
    {
        $cat->delete();
    }

    public function move(Category $cat, $where)
    {
        switch ($where) {
            case "up":
                $prev = $cat->getPrevSibling() ?: $cat->parent;
                if ($prev) {
                    $cat->beforeNode($prev)->save();
                }
                break;
            case "down":
                $next= $cat->getNextSibling();
                if ($next) {
                    $cat->afterNode($next)->save();
                }
                break;
        }
    }
}
