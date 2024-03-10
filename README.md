# Online Task Management System (React + Laravel)

Welcome to the Online Task Management System! This project is developed as part of the WCT (Web and Cloud Technology) module in the second semester of Year 3. It comprises both client-side, implemented using React, and server-side backend, implemented using Laravel.

## Introduction

This project aims to provide a comprehensive solution for managing tasks online. With features like user registration, task creation, organization, prioritization, real-time collaboration, and more, it offers a user-friendly interface for individuals and teams to efficiently manage their tasks.

## Features

- **User Registration and Authentication:** Allow users to register with unique credentials, verify their email addresses, and authenticate securely using JWT or third-party providers like Google OAuth.
  
- **Task Creation and Organization:** Users can create tasks with titles, descriptions, due dates, and priorities. Tasks can be organized into categories or projects with CRUD operations.

- **Task Prioritization and Sorting:** Users can prioritize tasks and sort them based on various criteria to manage their workload effectively.

- **Real-Time Collaboration and Teamwork:** Enable task collaboration with real-time updates and permissions management, facilitating teamwork and project coordination.

- **Task Tracking and Progress Monitoring:** Allow users to track task completion, monitor progress, and track time spent on tasks for better productivity management.

- **Trend and Visualization:** Offer visualizations like charts to visualize task completion rates and team performance insights, helping users gain valuable insights into their productivity.

- **Notifications and Reminders:** Send notifications for deadlines, assignments, and reminders via multiple channels to keep users informed and on track with their tasks.

## Technologies Used

- **Backend:** Laravel (PHP)
- **Database:** MySQL, SQLite, or PostgreSQL
- **Authentication:** JWT (JSON Web Tokens) and Laravel Passport for OAuth2 integration
- **Frontend:** React.js
- **Styling:** Tailwind CSS

## Installation

To run the project locally, follow these steps:

1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Install Laravel dependencies using `composer install`.
4. Rename `.env.example` to `.env` and configure your database credentials.
5. Generate Laravel application key using `php artisan key:generate`.
6. Run database migrations using `php artisan migrate`.
7. Install React dependencies using `npm install` or `yarn install`.
8. Start the Laravel development server with `php artisan serve`.
9. Start the React development server with `npm start` or `yarn start`.
10. Access the project in your browser at `http://localhost:3000`.

## Contributing

Contributions to the project are welcome! Whether you want to report bugs, suggest new features, or submit code improvements, please feel free to create issues or pull requests.

## License

This project is licensed under the ONTAME license, which means you are free to use, modify, and distribute the code as per the terms outlined in the license.

## Acknowledgements

Special thanks to Touch Ngounchhay for the guidance and support to this project.
Special thanks to LengKola/LanyMalis/ArtSanin/MamSovanratana for their support and contributions to this project.

## Demo

A live demo of the project can be accessed [here](link-to-live-demo), allowing you to explore the features and functionalities firsthand.
