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

use Radium\Http\Router;

Router::add('/', 'Ticketer::Controllers::Tickets.index');
Router::add('404', 'Ticketer::Controllers::Errors.notFound');

// User routes
Router::add('/(account|login|logout|register)', 'Ticketer::Controllers::Users.$1');
Router::add('/account/password', 'Ticketer::Controllers::Users.password');

// Ticket routes
Router::add('/tickets/new', 'Ticketer::Controllers::Tickets.new');
Router::add('/tickets/([0-9]+)', 'Ticketer::Controllers::Tickets.view/$1');

// Admin routes
Router::add('/admin', 'Ticketer::Controllers::Admin::Dashboard.index');
Router::add('/admin/settings', 'Ticketer::Controllers::Admin::Settings.index');
