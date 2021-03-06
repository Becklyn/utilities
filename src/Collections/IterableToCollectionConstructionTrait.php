<?php

namespace Becklyn\Utilities\Collections;


use Illuminate\Support\Collection;

/**
 * @author Marko Vujnovic <mv@201created.de>
 * @since  2019-06-13
 */
trait IterableToCollectionConstructionTrait
{
    protected function collectionFromIterable(iterable $var): Collection
    {
        return $var instanceof Collection ? $var: Collection::make($var);
    }
}
