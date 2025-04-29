<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    public function ponpes()
    {
        return inertia('Profile/ProfilePonpes');
    }

    public function ra()
    {
        return inertia('Profile/ProfileRa');
    }

    public function mts()
    {
        return inertia('Profile/ProfileMts');
    }

    public function ma()
    {
        return inertia('Profile/ProfileMa');
    }
}
