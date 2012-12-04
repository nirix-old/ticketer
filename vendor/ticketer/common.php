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

use Ticketer\Models\Setting;

/**
 * Returns the value of the requested setting.
 *
 * @param string $setting The setting to fetch
 *
 * @return string
 *
 * @package Ticketer
 */
function setting($setting) {
    static $CACHE = [];

    if (isset($CACHE[$setting])) {
        return $CACHE[$setting];
    }

    $data = Setting::find($setting);

    $CACHE[$setting] = $data ? $data->value : $data;
    return $CACHE[$setting];
}

function showErrors($errors)
{
    if (count($errors)) {
        View::render('errors/_errors', ['errors' => $errors]);
    }
}

/**
 * Fetches the translation for the specified string.
 *
 * @param string $string
 * @param array $variables
 *
 * @package Ticketer
 */
function l($string, $variables = [])
{
    global $language;
    return call_user_func_array([$language, 'translate'], func_get_args());
}
