<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /**
     * The faqs that belong to the tag.
     */
    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class);
    }
}
