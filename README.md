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

* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=voting_db
* DB_USERNAME=root
* DB_PASSWORD=

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

# UniVoting System — RESTful API

**Base URL:** `https://univotingsystem-production.up.railway.app`

This is a step-by-step guide for testing the UniVoting System's RESTful API endpoints using **Postman**.

---

## Table of Contents

- [Getting Started with Postman](#getting-started-with-postman)
- [Authentication](#authentication)
- [How to Add Bearer Token in Postman](#how-to-add-bearer-token-in-postman)
- [Candidates](#candidates)
- [Voters](#voters)
- [Results](#results)
- [HTTP Methods Summary](#http-methods-summary)

---

## Getting Started with Postman

1. Download and install [Postman](https://www.postman.com/downloads/).
2. Open Postman and click **New → HTTP Request**.
3. Select the HTTP method (GET, POST, PUT, etc.) from the dropdown.
4. Enter the full endpoint URL.
5. For protected routes, add your **Bearer Token** under the **Authorization** tab (see below).
6. Click **Send**.

---

## Authentication

The API uses **token-based authentication (Laravel Sanctum)**. You must log in first to get a token, then use that token as a **Bearer Token** on all protected endpoints.

---

### 1. Login

| | |
|---|---|
| **Method** | `POST` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/login` |
| **Auth Required** |  No |

Authenticates a user and returns an access token.

**Headers:**
| Key | Value |
|---|---|
| Content-Type | application/json |

**Request Body (JSON):**
```json
{
  "login_id": "your_student_id_or_username",
  "password": "your_password"
}
```

>  `login_id` accepts either a `student_id` (e.g. `2022-00001`) or a `username`.

**Success Response `200`:**
```json
{
  "token": "1|abcdefghijklmnop...",
  "user": {
    "id": 1,
    "student_id": "2022-00001",
    "username": "admin",
    "first_name": "Juan",
    "last_name": "Dela Cruz",
    "year_and_section": "4A",
    "college": "CCS",
    "role": "admin",
    "has_voted": false,
    "voted_at": null
  }
}
```

**Error Response `401`:**
```json
{
  "message": "Invalid credentials."
}
```

**Postman Steps:**
1. Set method to `POST`.
2. Enter the URL: `https://univotingsystem-production.up.railway.app/api/login`
3. Go to **Body → raw → JSON**.
4. Paste the request body.
5. Click **Send**.
6. **Copy the `token` value** — you will need it for all protected routes.

---

### 2. Logout

| | |
|---|---|
| **Method** | `POST` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/logout` |
| **Auth Required** |  Yes (Bearer Token) |

Invalidates the current user's token. After logout, the token can no longer access protected routes.

**Success Response `200`:**
```json
{
  "message": "Logged out successfully."
}
```

---

## How to Add Bearer Token in Postman

For all protected routes, follow these steps before clicking **Send**:

1. Click the **Authorization** tab.
2. Under **Auth Type**, select **Bearer Token**.
3. Paste your token (from the login response) into the **Token** field.
4. Click **Send**.

---

## Candidates

---

### Get All Candidates

| | |
|---|---|
| **Method** | `GET` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates` |
| **Auth Required** |  Yes (Bearer Token) |

Retrieves all candidates with their associated position.

**Sample Response `200`:**
```json
[
  {
    "id": 1,
    "position_id": 1,
    "last_name": "Dela Cruz",
    "first_name": "Juan",
    "college": "CCS",
    "partylist": "Unity Party",
    "is_active": true,
    "created_at": "2026-06-01T00:00:00.000000Z",
    "updated_at": "2026-06-01T00:00:00.000000Z",
    "position": {
      "id": 1,
      "name": "President",
      "department": "executive",
      "college": null,
      "max_winners": 1,
      "display_order": 1
    }
  }
]
```

---

### Get One Candidate

| | |
|---|---|
| **Method** | `GET` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/candidates/1` |

**Error Response `404`:**
```json
{
  "message": "Candidate not found!"
}
```

---

### Add a Candidate

| | |
|---|---|
| **Method** | `POST` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates` |
| **Auth Required** |  Yes (Bearer Token) |

**Headers:**
| Key | Value |
|---|---|
| Content-Type | application/json |
| Authorization | Bearer `<your_token>` |

**Request Body (JSON):**
```json
{
  "position_id": 1,
  "last_name": "Santos",
  "first_name": "Maria",
  "college": "CAS",
  "partylist": "Progress Party",
  "is_active": true
}
```

**Field Reference:**
| Field | Type | Required | Description |
|---|---|---|---|
| `position_id` | integer |  Yes | Must exist in the `positions` table |
| `last_name` | string |  Yes | Candidate's last name |
| `first_name` | string |  Yes | Candidate's first name |
| `college` | string |  Yes | College of the candidate |
| `partylist` | string |  Optional | Party affiliation |
| `is_active` | boolean |  Optional | Defaults to `true` |

**Success Response `201`:**
```json
{
  "id": 2,
  "position_id": 1,
  "last_name": "Santos",
  "first_name": "Maria",
  "college": "CAS",
  "partylist": "Progress Party",
  "is_active": true,
  "created_at": "2026-06-07T00:00:00.000000Z",
  "updated_at": "2026-06-07T00:00:00.000000Z"
}
```

---

### Full Update a Candidate

| | |
|---|---|
| **Method** | `PUT` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/candidates/1` |

>  `PUT` replaces the **entire record**. All required fields must be included.

**Request Body (JSON):**
```json
{
  "position_id": 2,
  "last_name": "Santos",
  "first_name": "Maria",
  "college": "CBA",
  "partylist": "Progress Party",
  "is_active": true
}
```

---

### Partial Update a Candidate

| | |
|---|---|
| **Method** | `PATCH` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/candidates/1` |

>  Send only the fields you want to update.

**Request Body (JSON):**
```json
{
  "college": "CBA"
}
```

**Patchable Fields:**
| Field | Type |
|---|---|
| `position_id` | integer |
| `last_name` | string |
| `first_name` | string |
| `college` | string |
| `partylist` | string / null |
| `is_active` | boolean |

---

### Delete All Candidates

| | |
|---|---|
| **Method** | `DELETE` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates` |
| **Auth Required** |  Yes (Bearer Token) |

>  This **permanently deletes all candidates** in the database. Use with caution.

**Success Response `200`:**
```json
{
  "message": "All candidates deleted successfully!"
}
```

---

### Delete a Candidate

| | |
|---|---|
| **Method** | `DELETE` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/candidates/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/candidates/1` |

**Success Response `200`:**
```json
{
  "message": "Candidate deleted successfully!"
}
```

---

## Voters

---

### Get All Voters

| | |
|---|---|
| **Method** | `GET` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters` |
| **Auth Required** |  Yes (Bearer Token) |

Retrieves all users with `role = voter`.

**Sample Response `200`:**
```json
[
  {
    "id": 5,
    "student_id": "2022-00050",
    "username": null,
    "first_name": "Pedro",
    "last_name": "Reyes",
    "year_and_section": "3B",
    "college": "CAS",
    "role": "voter",
    "has_voted": false,
    "voted_at": null
  }
]
```

---

### Get One Voter

| | |
|---|---|
| **Method** | `GET` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/voters/5` |

**Error Response `404`:**
```json
{
  "message": "Voter not found!"
}
```

---

### Add a Voter

| | |
|---|---|
| **Method** | `POST` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters` |
| **Auth Required** |  Yes (Bearer Token) |

**Headers:**
| Key | Value |
|---|---|
| Content-Type | application/json |
| Authorization | Bearer `<your_token>` |

**Request Body (JSON):**
```json
{
  "student_id": "2022-00099",
  "first_name": "Pedro",
  "last_name": "Reyes",
  "year_and_section": "3B",
  "college": "CAS",
  "password": "securepassword"
}
```

**Field Reference:**
| Field | Type | Required | Description |
|---|---|---|---|
| `student_id` | string |  Yes | Must be unique |
| `first_name` | string |  Yes | Voter's first name |
| `last_name` | string |  Yes | Voter's last name |
| `year_and_section` | string |  Yes | e.g. `3B`, `4A` |
| `college` | string |  Yes | e.g. `CCS`, `CAS`, `CBA` |
| `password` | string |  Yes | Minimum 6 characters |
| `program` | string |  Optional | Degree program |

**Success Response `201`:**
```json
{
  "id": 10,
  "student_id": "2022-00099",
  "first_name": "Pedro",
  "last_name": "Reyes",
  "year_and_section": "3B",
  "college": "CAS",
  "role": "voter",
  "has_voted": false,
  "voted_at": null
}
```

---

### Full Update a Voter

| | |
|---|---|
| **Method** | `PUT` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/voters/5` |

>  All required fields must be included. `password` is optional — if omitted, the existing password is kept.

**Request Body (JSON):**
```json
{
  "student_id": "2022-00099",
  "first_name": "Pedro",
  "last_name": "Cruz",
  "year_and_section": "4A",
  "college": "CCS",
  "password": "newpassword"
}
```

---

### Partial Update a Voter

| | |
|---|---|
| **Method** | `PATCH` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/voters/5` |

>  Send only the fields you want to update.

**Request Body (JSON):**
```json
{
  "year_and_section": "4A"
}
```

**Patchable Fields:**
| Field | Type |
|---|---|
| `student_id` | string (unique) |
| `first_name` | string |
| `last_name` | string |
| `year_and_section` | string |
| `college` | string |
| `program` | string / null |
| `password` | string (min: 6) |
| `has_voted` | boolean |

---

### Delete All Voters

| | |
|---|---|
| **Method** | `DELETE` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters` |
| **Auth Required** |  Yes (Bearer Token) |

>  This **permanently deletes all voters** in the database. Use with caution.

**Success Response `200`:**
```json
{
  "message": "All voters deleted successfully!"
}
```

---

### Delete a Voter

| | |
|---|---|
| **Method** | `DELETE` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/voters/{id}` |
| **Auth Required** |  Yes (Bearer Token) |
| **Example** | `https://univotingsystem-production.up.railway.app/api/voters/5` |

**Success Response `200`:**
```json
{
  "message": "Voter deleted successfully!"
}
```

---

## Results

### Get Election Results

| | |
|---|---|
| **Method** | `GET` |
| **URL** | `https://univotingsystem-production.up.railway.app/api/results` |
| **Auth Required** |  Yes (Bearer Token) |

Retrieves all positions with their candidates and vote counts, ordered by `display_order`.

**Sample Response `200`:**
```json
[
  {
    "position": "President",
    "department": "executive",
    "college": null,
    "candidates": [
      {
        "candidate_id": 1,
        "candidate_name": "Juan Dela Cruz",
        "college": "CCS",
        "votes": 120
      },
      {
        "candidate_id": 2,
        "candidate_name": "Maria Santos",
        "college": "CAS",
        "votes": 95
      }
    ]
  },
  {
    "position": "CCS Governor",
    "department": "legislative",
    "college": "CCS",
    "candidates": [
      {
        "candidate_id": 5,
        "candidate_name": "Anna Cruz",
        "college": "CCS",
        "votes": 60
      }
    ]
  }
]
```

---

## HTTP Methods Summary

| Method | URL | Description |
|--------|-----|-------------|
| `POST` | `/api/login` | Login and get token |
| `POST` | `/api/logout` | Logout and invalidate token |
| `GET` | `/api/candidates` | Get all candidates |
| `GET` | `/api/candidates/{id}` | Get one candidate |
| `POST` | `/api/candidates` | Add a new candidate |
| `PUT` | `/api/candidates/{id}` | Full update a candidate |
| `PATCH` | `/api/candidates/{id}` | Partial update a candidate |
| `DELETE` | `/api/candidates` | Delete **all** candidates |
| `DELETE` | `/api/candidates/{id}` | Delete one candidate |
| `GET` | `/api/voters` | Get all voters |
| `GET` | `/api/voters/{id}` | Get one voter |
| `POST` | `/api/voters` | Add a new voter |
| `PUT` | `/api/voters/{id}` | Full update a voter |
| `PATCH` | `/api/voters/{id}` | Partial update a voter |
| `DELETE` | `/api/voters` | Delete **all** voters |
| `DELETE` | `/api/voters/{id}` | Delete one voter |
| `GET` | `/api/results` | Get election results |

---

## Security Notes

- Always keep your **Bearer Token** private — do not share it.
- The token is **invalidated after logout** — do not reuse old tokens.
- Only `admin` accounts have access to protected API routes.
- Passwords are stored as **hashed values** (bcrypt) and are never returned in API responses.

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
