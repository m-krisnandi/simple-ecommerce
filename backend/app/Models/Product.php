<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'brand',
        'image_url',
        'slug'
    ];

    // Mutator untuk mengatur slug sebelum menyimpan ke database
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Meng-update slug saat model diperbarui
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->attributes['name']);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
