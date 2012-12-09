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
use Ticketer\Models\Department;

/**
 * Departments controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Departments extends AppController
{
    /**
     * Department listing.
     */
    public function indexAction()
    {
        $this->set('departments', Department::all());
    }

    /**
     * New department.
     */
    public function newAction()
    {
        $department = new Department;

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $this->save($department);
        }

        $this->set(compact('department'));
    }

    /**
     * Edit department.
     */
    public function editAction($id)
    {
        $department = Department::find($id);

        // Make sure the department exists
        if (!$department) {
            return $this->show404();
        }

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $this->save($department);
        }

        $this->set(compact('department'));
    }

    /**
     * Save department.
     *
     * @param object $department
     */
    public function save($department)
    {
        $department->set([
            'name'     => Request::$post['name'],
        ]);

        if ($department->save()) {
            Request::redirectTo('/admin/departments');
        }
    }

}
