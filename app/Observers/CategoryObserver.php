<?php

namespace App\Observers;

use App\Models\Article;
use Cache;

class CategoryObserver extends BaseObserver
{
    public function deleting($category)
    {
        if (Article::where('category_id', $category->id)->count() !== 0) {
            flash_error('请先删除此分类下的文章');
            return false;
        }
    }

    protected function clearCache()
    {
        Cache::forget('common:category');
    }
}
