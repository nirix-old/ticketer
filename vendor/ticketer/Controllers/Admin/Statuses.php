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
use Ticketer\Models\Status;

/**
 * Statuses controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class Statuses extends AppController
{
    /**
     * Status listing.
     */
    public function indexAction()
    {
        $this->set('statuses', Status::all());
    }

    /**
     * New status.
     */
    public function newAction()
    {
        $status = new Status;

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $this->save($status);
        }

        $this->set(compact('status'));
    }

    /**
     * Edit status.
     */
    public function editAction($id)
    {
        $status = Status::find($id);

        // Make sure the status exists
        if (!$status) {
            return $this->show404();
        }

        // Check if the form has been submitted
        if (Request::method() == 'post') {
            $this->save($status);
        }

        $this->set(compact('status'));
    }

    /**
     * Save status.
     *
     * @param object $status
     */
    public function save($status)
    {
        $status->set([
            'name'     => Request::$post['name'],
        ]);

        if ($status->save()) {
            Request::redirectTo('/admin/statuses');
        }
    }

}
