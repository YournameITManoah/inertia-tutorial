<?php

namespace Illuminate\Support\Facades;

interface Auth
{
    /**
     * Get the currently authenticated user.
     *
     * @return \App\Models\User|null
     */
    public static function user();
}
