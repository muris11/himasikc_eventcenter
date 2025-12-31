<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'date',
        'location',
        'organizer',
        'image_path',
        'registration_link',
        'is_active',
        'event_category_id',
        'participant_type',
        'latitude',
        'longitude',
        'is_featured',
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the category that belongs to this event
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    /**
     * Get all images for the event (polymorphic)
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable')->orderBy('id');
    }
}
