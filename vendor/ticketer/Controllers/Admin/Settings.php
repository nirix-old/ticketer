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

namespace Ticketer\Controllers\Admin;

use Radium\Http\Request;
use Ticketer\Models\Setting;

/**
 * Settings controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Settings extends AppController
{
    public function indexAction()
    {
        // Check if the form has been submitted
        if (Request::method() == 'post') {
            foreach (Request::$post['settings'] as $setting => $value) {
                // Get setting
                $setting = Setting::find('setting', $setting);

                // If found, set value and save
                if ($setting) {
                    $setting->value = $value;
                    $setting->save();
                }
            }

            // Redirect
            Request::redirectTo('/admin/settings');
        }
    }
}
