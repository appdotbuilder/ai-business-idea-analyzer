<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BusinessIdea
 *
 * @property int $id
 * @property string $description
 * @property string|null $title
 * @property array|null $analysis
 * @property float|null $overall_score
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea query()
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereOverallScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BusinessIdea whereUpdatedAt($value)
 * @method static \Database\Factories\BusinessIdeaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class BusinessIdea extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'description',
        'title',
        'analysis',
        'overall_score',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'analysis' => 'array',
        'overall_score' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_ideas';
}