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
            'users'     => "Users",
            'login'     => "Login",
            'logout'    => "Logout",
            'register'  => "Register",
            'name'      => "Name",
            'username'  => "Username",
            'password'  => "Password",
            'email'     => "Email",
            'newest'    => "Newest",
            'account'   => "Account",
            'admin'     => "Admin",
            'staff'     => "Staff",
            'group'     => "Group",

            // Account Page
            'information'      => "Information",
            'current_password' => "Current Password",
            'new_password'     => "New Password",

            // Tickets
            'tickets'       => "Tickets",
            'new_ticket'    => "New Ticket",
            'update_ticket' => "Update Ticket",
            'id'            => "ID",
            'summary'       => "Summary",
            'issue'         => "Issue",
            'department'    => "Department",
            'priority'      => "Priority",
            'status'        => "Status",
            'created'       => "Created",
            'updated'       => "Updated",
            'open'          => "Open",
            'resolved'      => "Resolved",
            'total'         => "Total",
            'created_by'    => "Created by",

            // Ticket changes
            'tickets.changes.department_from_x_to_x' => "Changed department from <code>{1}</code> to <code>{2}</code>",
            'tickets.changes.status_from_x_to_x' => "Changed status from <code>{1}</code> to <code>{2}</code>",
            'tickets.changes.priority_from_x_to_x' => "Changed priority from <code>{1}</code> to <code>{2}</code>",

            // Admin
            'admincp'         => "AdminCP",
            'settings'        => "Settings",
            'departments'     => "Departments",
            'statuses'        => "Statuses",
            'title'           => "Title",
            'language'        => "Language",
            'actions'         => "Actions",
            'edit'            => "Edit",
            'delete'          => "Delete",
            'edit_user'       => "Edit User",
            'new_department'  => "New Department",
            'edit_department' => "Edit Department",
            'new_status'      => "New Status",
            'edit_status'     => "Edit Status",

            // Forms
            'create_ticket' => "Create Ticket",
            'create'        => "Create",
            'update'        => "Update",
            'save'          => "Save",

            // Time
            'never'         => "Never",
            'time'          => "Time",
            'time.ago'      => "{1} ago",
            'time.from_now' => "{1} from now",
            'time.x_and_x'  => "{1} and {2}",
            'time.x_second' => "{1} {plural:{1}, {second|seconds}}",
            'time.x_minute' => "{1} {plural:{1}, {minute|minutes}}",
            'time.x_hour'   => "{1} {plural:{1}, {hour|hours}}",
            'time.x_day'    => "{1} {plural:{1}, {day|days}}",
            'time.x_week'   => "{1} {plural:{1}, {week|weeks}}",
            'time.x_month'  => "{1} {plural:{1}, {month|months}}",
            'time.x_year'   => "{1} {plural:{1}, {year|years}}",

            // ------------------------------------------------------------------------------------
            // Confirmations
            'confirm.delete_x' => "Are you sure you want to delete '{1}' ?",

            // ------------------------------------------------------------------------------------
            // Errors
            'errors.invalid_username_or_password' => "Invalid username or password",
            'errors.current_password_is_invalid'  => "Current password is invalid",

            // Page not found
            'errors.404.title'   => "Oh noes!",
            'errors.404.message' => "The page you're looking for doesn't seem to exist, sorry.",

            // No permission
            'errors.no_permission.title'   => "You didn't say the magic word",
            'errors.no_permission.message' => "You don't have permission to access this page.",

            // Validation errors
            'errors.validations.required'        => "{1} is required",
            'errors.validations.must_be_email'   => "{1} is invalid",
            'errors.validations.field_too_short' => "{1} is too short",
            'errors.validations.already_in_use'  => "{1} is already in use"
        ];
    }
}
