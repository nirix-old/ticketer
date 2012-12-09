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

namespace Ticketer\Controllers;

use Radium\Output\View;
use Radium\Database;

use Ticketer\Models\User;

/**
 * Application controller.
 *
 * @package Ticketer
 * @subpackage Controllers
 */
class AppController extends \Radium\Core\Controller
{
    private $title = [];

    public function __construct()
    {
        parent::__construct();

        View::$inheritFrom = APPPATH . '/views/default';

        $this->db = Database::connection();
        $this->getUser();

        $this->title(setting('title'));
    }

    /**
     * Adds the string to the page title array.
     *
     * @param string $title
     */
    public function title($string)
    {
        $this->title[] = $string;
        $this->set('title', $this->title);
    }

    /**
     * Send the variable to the view.
     *
     * @param string|array $var
     * @param mixed $val
     */
    public function set($var, $val = null)
    {
        View::set($var, $val);
    }

    /**
     * Renders the specified view.
     *
     * @param string $view
     */
    public function render($view, $variables = [])
    {
        View::render($view, $variables);
    }

    /**
     * Renders the 404 view.
     */
    protected function show404()
    {
        View::render('errors/not_found');
        return '';
    }

    /**
     * Renders the no permission view.
     */
    protected function showNoPermission()
    {
        View::render('errors/no_permission');
        return '';
    }

    /**
     * Does the checking for the session cookie and fetches the users info.
     *
     * @access private
     */
    private function getUser()
    {
        // Check if the session cookie is set, if so, check if it matches a user
        // and set set the user info.
        if (isset($_COOKIE['ticketer']) and $user = User::find('login_hash', $_COOKIE['ticketer'])) {
            $this->currentUser = $user;
            define("LOGGEDIN", true);
        }
        // Otherwise just set the user info to guest.
        else {
            $this->currentUser = new User(array(
                'id'       => 0,
                'username' => l('guest'),
                'group_id' => 3
            ));
            define("LOGGEDIN", false);
        }

        // Set the current_user variable in the views.
        View::set('currentUser', $this->currentUser);
    }

    /**
     * Handles the applications shut down.
     */
    public function __shutdown()
    {
        $this->set('totalQueries', $this->db->queryCount());
        parent::__shutdown();
    }
}
