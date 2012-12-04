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

namespace Ticketer\Models;

/**
 * Department model.
 *
 * @package Ticketer
 * @subpackage Models
 */
class Department extends \Radium\Database\Model
{
    protected static $_table = 'departments';

    /**
     * Returns an array formatted for the Form::select() helper.
     *
     * @return array
     */
    public static function selectOptions()
    {
        $options = [];

        foreach (static::all() as $row) {
            $options[] = ['label' => $row->name, 'value' => $row->id];
        }

        return $options;
    }
}
