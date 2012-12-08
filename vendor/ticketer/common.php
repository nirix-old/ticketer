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

/**
 * Returns time ago in words of the given date.
 *
 * @param string  $original
 * @param boolean $detailed
 *
 * @return string
 */
function timeAgo($timestamp, $detailed = false)
{
    return l('time.ago', Time::agoInWords($timestamp, $detailed));
}

/**
 * Nicely displays the passed errors from a model.
 *
 * @param array $errors
 */
function showErrors($errors)
{
    if (count($errors)) {
        View::render('errors/_errors', ['errors' => $errors]);
    }
}

/**
 * Returns an array of priorities.
 *
 * @return array
 */
function priorities()
{
    return [
        1 => l('Highest'),
        2 => l('High'),
        3 => l('Normal'),
        4 => l('Low')
    ];
}

/**
 * Returns priorities array in the format
 * for the Form::select() helper.
 *
 * @return array
 */
function prioritySelectOptions()
{
    $options = [];

    foreach (priorities() as $id => $priority) {
        $options[] = ['label' => $priority, 'value' => $id];
    }

    return $options;
}
