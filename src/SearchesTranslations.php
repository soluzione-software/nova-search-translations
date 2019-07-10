<?php

namespace SoluzioneSoftware\Nova\SearchTranslations;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait SearchesTranslations
{
    /**
     * The translated columns that should be searched.
     *
     * @var array
     */
    public static $searchTranslations = [];

    /**
     * Get the searchable translated columns for the resource.
     *
     * @return array
     */
    public static function searchableTranslatedColumns()
    {
        return static::$searchTranslations;
    }

    /**
     * Apply the search query to the query.
     *
     * @param  Builder  $query
     * @param  string  $search
     * @return Builder
     */
    protected static function applyTranslatedSearch($query, $search)
    {
        return $query->orWhere(function ($query) use ($search) {
            foreach (static::searchableTranslatedColumns() as $column) {
                $query->orWhereTranslationLike($column, '%'.$search.'%');
            }
        });
    }

}
