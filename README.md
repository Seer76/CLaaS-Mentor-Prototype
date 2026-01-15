# CLaaS Mentor Platform

A comprehensive learning management and mentorship platform designed to facilitate personalized learning, mentor-mentee interactions, and progress tracking.

## key Features

### For Learners
- **Dashboard**: Centralized view of progress and upcoming activities.
- **Skills Passport & Scorecard**: Track skill acquisition and performance metrics.
- **Chat**: Real-time communication with mentors.
- **Support Tickets**: Raise and track support requests.
- **Schedule Requests**: Book sessions with mentors.

### For Mentors
- **Dashboard**: Overview of assigned mentees and pending tasks.
- **Ticket Management**: View, assign, and resolve support tickets.
- **Schedule Management**: Review and manage session requests.
- **Notifications**: Stay updated on mentee activities.

### For Managers
- **Dashboard**: High-level view of cohort progress.
- **Cohort Management**: specific views for learner cohorts.
- **Mentor Assignment**: Assign mentors to learning plans.

### For Admins
- **User Management**: Create and manage users (Admin, Manager, Mentor, Learner).
- **System Oversight**: access to all tickets and system-wide settings.

### Common Features
- **Forum**: A shared space for discussions and knowledge sharing.

## Prerequisites

Ensure you have the following installed:
- [PHP](https://www.php.net/) (v8.2 or higher)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) & [NPM](https://www.npmjs.com/)

## Getting Started

### 1. Setup
If this is your first time checking out the repository, run the setup script. This will install PHP and Node dependencies, setup the environment file, generate keys, and run database migrations.

```bash
composer run setup
```

### 2. Run Locally
To start the development environment, including the Laravel server, Queue worker, Logs, and Vite frontend:

```bash
composer run dev
```

Alternatively, you can run services individually:
*   Backend: `php artisan serve`
*   Frontend: `npm run dev`
*   Queues: `php artisan queue:listen`

### 3. Testing
To run the automated test suite:

```bash
composer run test
```
