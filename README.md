## Project Description 

UniVoting System  - This UniVoting System is designed to make the voting process faster, more organized, and secure. It allows registered voters to cast their votes electronically through a user-friendly interface. The system includes separate dashboards for voters and administrator to manage voting activities efficiently.

Voters can log in to their accounts, view the list of candidates, and submit their votes. The system ensures that each voter can vote only once to maintain the integrity of the election. After voting, the vote is securely recorded in the database.

Administrators have access to a dedicated dashboard where they can manage voter accounts, candidate information, and monitor voting results in real time. They can also generate reports and oversee the overall election process.

By replacing manual voting procedures, the UninVoting System improves accuracy, reduces counting errors, saves time, and provides a transparent and reliable voting experience for all participants.


## Developers

* Inoue, Kate Diane G.
* Rico, Raphael Russel T.
* Torio, Nathalie Kate L.

## How the system works

1. Account Registration
   • If a user does not have an existing account, they can click the "Create an Account" button on the login page.
   • The user fills out the registration form by providing the required information, such as their Student ID, Name (Last Name, First Name), Year & Section, College, Password and Confirm Password.
   • After clicking the "Register Button", the system creates a new account and stores the user's information securely in the database.
2. User Login
   • Once registered, the user can log in using their student id and password.
   • If the login details are correct, the user is redirected to the User Dashboard.
   • However, if the student id or password is incorrect, the system redirects the user back to the login page and displays an error message stating "Invalid Credentials", allowing the user to try logging in again.
3. User Dashboard
   • The User Dashboard serves as the main page for voters after logging in.
   • It displays important information such as voting progress, and the election dashboard where you can now choose your candidate for a specific position.
   • After voting you will now review & submit your vote by clicking the "review & submit button", where you can edit you vote before officially submitting it.
   • After clicking the submit button, it will display a message stating "Vote Submitted!" and your status if you're already voted or not. Lastly, you will see when and what time did you vote.
   • You can also view the transparency dashboard, where you can see the numbers of registered voters, voters submitted, total vote entries, and the election results by position.
4. Administrator Dashboard
   • Administrators log in through the Admin Dashboard.
   • They can manage candidates, voters, voters by colleges and monitor vote counts or the results.
   • The system automatically tallies votes and displays results for authorized administrators.
   • The admin can also export the names of voter, candidates, and the most important the results.

## Installation/setup instructions

# System Requirements

* PHP 8.3 or 8.4
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

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

6. Create the Database

Create a new database named laravel using sqlite

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

*Railway
