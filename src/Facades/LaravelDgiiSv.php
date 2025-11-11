<?php

namespace DazzaDev\LaravelDgiiSv\Facades;

use DazzaDev\DgiiSv\Client;
use DazzaDev\DgiiSv\Listing;
use Illuminate\Support\Facades\Facade;

class LaravelDgiiSv extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-dgii-sv';
    }

    /**
     * Get the client instance.
     */
    public static function getClient(): Client
    {
        return app('laravel-dgii-sv');
    }

    /**
     * Get the listings.
     */
    public static function getListings(): array
    {
        return Listing::getListings();
    }

    /**
     * Get the listing by type.
     */
    public static function getListing(string $type): array
    {
        return Listing::getListing($type);
    }
}
