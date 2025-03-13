# Task Management Application

## Overview

The application allows users to create, manage, and assign tasks within a team environment, featuring a clean and responsive user interface built with **Tailwind CSS**.

## Key Features

-   **Task Management**: Create, edit, delete, and track tasks.
-   **Task Assignment**: Assign tasks to multiple team members.
-   **Status Tracking**: Toggle task status between "In Progress" and "Completed".
-   **Due Date Management**: Set and manage task due dates.
-   **Responsive Design**: Fully functional on both desktop and mobile devices.
-   **Filtering**: Filter tasks by status.

## Installation & Setup

**Clone the repository:**
git clone
cd task-app-exercise

**Install dependencies**
composer install
npm install

**Run migrations**
php artisan migrate

**Create a user and use task seeder**
Register a user (Task seeder uses user_id 1)
php artisan db:seed --class=TaskSeeder

**Compile assets**
npm run build

**Start the server**
php artisan serve
