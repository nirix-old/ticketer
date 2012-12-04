<?php
/*!
 * Ticketer
 * Copyright (C) 2012 Jack P.
 * https://github.com/nirix
 *
 * This file is part of Ticketer.
 *
 * Ticketer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 *
 * Ticketer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ticketer. If not, see <http://www.gnu.org/licenses/>.
 */

class enAU extends \Radium\Language\Translation
{
    protected static $info = [
        'name'   => "English (Australian)",
        'author' => "Jack P",

        // Language information
        'language'       => "English",
        'language_short' => "en",
        'locale'         => 'AU'
    ];

    protected function strings()
    {
        return [
            'copyright' => "Powered by Ticketer &copy; Jack P.",

            // Users
            'login'     => "Login",
            'register'  => "Register",
            'name'      => "Full name",
            'username'  => "Username",
            'password'  => "Password",
            'email'     => "Email",

            // Tickets
            'tickets'    => "Tickets",
            'new_ticket' => "New Ticket",
            'id'         => "ID",
            'summary'    => "Summary",
            'status'     => "Status",
            'created'    => "Created",
            'updated'    => "Updated",

            // Errors
            'errors.invalid_username_or_password' => "Invalid username or pasword",

            // Validation errors
            'errors.validations.required'        => "{1} is required",
            'errors.validations.must_be_email'   => "{1} is invalid",
            'errors.validations.field_too_short' => "{1} is too short"
        ];
    }
}
