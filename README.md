## Project Description 

UniVoting System  - The UniVoting System is designed to make the voting process faster, more organized, and secure. It allows registered voters to cast their votes electronically through a user-friendly interface. The system includes separate dashboards for voters and administrator to manage voting activities efficiently.

Voters can log in to their accounts, view the list of candidates, and submit their votes. The system ensures that each voter can vote only once to maintain the integrity of the election. After voting, the vote is securely recorded in the database.

Administrators have access to a dedicated dashboard where they can manage voter accounts, candidate information, and monitor voting results in real time. They can also generate reports and oversee the overall election process.

By replacing manual voting procedures, the UninVoting System improves accuracy, reduces counting errors, saves time, and provides a transparent and reliable voting experience for all participants.


## Developers

* Inoue, Kate Diane G.
* Rico, Raphael Russel T.
* Torio, Nathalie Kate L.

## How the system works

1. Account Registration
   * If a user does not have an existing account, they can click the "Create an Account" button on the login page.
   * The user fills out the registration form by providing the required information, such as their Student ID, Name (Last Name, First Name), Year & Section, College, Password and Confirm Password.
   * After clicking the "Register Button", the system creates a new account and stores the user's information securely in the database.
2. User Login
   * Once registered, the user can log in using their student id and password.
   * If the login details are correct, the user is redirected to the User Dashboard.
   * However, if the student id or password is incorrect, the system redirects the user back to the login page and displays an error message stating "Invalid Credentials", allowing the user to try logging in again.
3. User Dashboard
   * The User Dashboard serves as the main page for voters after logging in.
   * It displays important information such as voting progress, and the election dashboard where you can now choose your candidate for a specific position.
   * After voting you will now review & submit your vote by clicking the "review & submit button", where you can edit you vote before officially submitting it.
   * After clicking the submit button, it will display a message stating "Vote Submitted!" and your status if you're already voted or not. Lastly, you will see when and what time did you vote.
   * You can also view the transparency dashboard, where you can see the numbers of registered voters, voters submitted, total vote entries, and the election results by position.
4. Administrator Dashboard
   * Administrators log in through the Admin Dashboard.
   * They can manage candidates, voters, voters by colleges and monitor vote counts or the results.
   * The system automatically tallies votes and displays results for authorized administrators.
   * The admin can also export the names of voter, candidates, and the most important the results.

## Installation/setup instructions

# System Requirements

* PHP 8.3 or higher
* Composer
* sqlite Database
* VsCode
* Laravel Framework
* Web Browser (Google Chrome, Microsoft Edge, Firefox, etc.)

# Installation Steps
1. Obtain the Project Files

Download or clone the UniVoting System project to your repository in Github.

2. Open the Project Directory

Open a terminal or command prompt and navigate to the project folder.

Example:

cd UniVoting-system

3. Install Project Dependencies

Run the following command to install all required PHP packages:

composer install

4. Configure the Environment File

Create a copy of the environment file:

cp .env.example .env

For Windows:

copy .env.example .env

5. Configure the Database

Open the .env file and update the database configuration:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voting_db
DB_USERNAME=root
DB_PASSWORD=

6. Create the Database

Create a new database named voting_db using mysql

7. Generate the Application Key

Run:

php artisan key:generate

8. Run Database Migrations

Execute the following command to create the necessary database tables:

php artisan migrate

If seeders are included in the project, run:

php artisan db:seed

9. Start the Application

Launch the Laravel development server:

php artisan serve

The system can then be accessed through:

http://127.0.0.1:8000

## Tutorial of API using POSTMAN
Our system includes RESTful API endpoints to access and manage data through HTTP requests. These APIs are useful for backend testing using tools like Postman, and they also make the system more flexible if it needs to be connected to other frontend or mobile applications in the future.

In our project, we created API endpoints for managing candidates, voters, users, and results.

# Candidate API
For the candidates API, we use:
GET /api/candidates
This retrieves all candidates from the database.
GET /api/candidates/{id}
This retrieves one specific candidate using the candidate ID.
POST /api/candidates
This adds a new candidate to the database.
PUT /api/candidates/{id}
This updates all required fields of an existing candidate.
PATCH /api/candidates/{id}
This updates only selected fields of a candidate.
DELETE /api/candidates/{id}
This deletes a specific candidate.

# Voters and Users API
For the Voters API, the same RESTful structure is used. We have endpoints to retrieve all voters, retrieve a specific voter, add a new voter, update voter information, partially update voter information, and delete a voter.

For the Users API, it can manage all users, including both administrator and voter accounts, depending on the system configuration.

# Results API
The results API is used to retrieve the election results. It gets the positions, candidates, and vote counts so the admin can view the real-time tally of votes.

# Authentication API
We also included API authentication using token-based login.
The user can send their login credentials to: POST /api/login
If the login is successful, the system returns a token. This token is used in Postman as a Bearer Token to access protected API routes.

# Logout API
We also have a logout endpoint: POST /api/logout
The purpose of this endpoint is to invalidate or delete the current token of the logged-in user. After logging out, the old token can no longer be used to access protected API routes.

This is important for security because even if someone possesses the previous token, it will no longer be valid once the user has logged out.

# User Registration and Login
1. Open the Voting System in a web browser.
2. If the user does not have an account, click "Create an Account" and complete the registration form.
3. Log in using the registered student id and password.
4. Upon successful login, the user is redirected to the User Dashboard.
5. If incorrect credentials are entered, the user is redirected back to the login page and an "Invalid Credentials" message is displayed.

# Voting Process
1. From the User Dashboard, you can just click the candidate you want from a specific position.
2. Submit the vote and confirm the selection.
3. Review the list of candidates displayed by the system.
4. The system records the vote and updates the user's voting status.
5. Once a vote has been submitted, the user cannot vote again for the same credentials from the login.

# Administrator Access

1. Log in using the administrator credentials.
2. Access the Admin Dashboard.
3. Manage candidates, voters, voters by colleges and monitor vote counts or the results and,
4. The admin can also export the names of voter, candidates, and the most important the results.

## Hosting Link

https://univotingsystem-production.up.railway.app/?fbclid=IwY2xjawSQpyJleHRuA2FlbQIxMQBzcnRjBmFwcF9pZAEwAAEeXOB_M1HxHytfhyBRd2nnccm1UDHDzLNLaS9IQ8HjC_YZmrkw_D3V2GePVIk_aem_xIvFelD7lFrF7f6wvL054Q
