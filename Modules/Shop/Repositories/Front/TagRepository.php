<?php

namespace Modules\Shop\Repositories\Front;

use Modules\Shop\Repositories\Front\Interface\TagRepositoryInterface;
use Modules\Shop\App\Models\Tag;

class TagRepository implements TagRepositoryInterface {

  public function findAll($options = [])
  {
    return Tag::orderBy('name', 'asc')->get();
  }

  public function findBySlug($slug)
  {
    return Tag::where('slug', $slug)->firstOrFail();
  }
}

