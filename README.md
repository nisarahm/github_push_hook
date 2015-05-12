# GitHub Push Hook Receiver

This script acts as a WebHook listener for GitHub's Webhooks. It is designed to keep track of a commit's push date from any repo's who has subscribed to this receiver. The typical use case is to find out when a student really pushed their commit to GitHub and use that date as the submission date, since the commit dates are easily forgeable.

## Usage

On every single `push` with registered repository, the script will record two things to the database:

- a record of the GitHub payload to the `events` table
- a record of each commit in the `push` by their SHA, and the time that it was pushed, to the `pushes` table.

Then, there is a simple `check.php` script which acts as an API - given the params `sha` and `github_user`, it will return a JSON of recorded information.

## Setup

To setup, make sure you have access to a database and a web server.

1. Modify `init.sql` and change the table names to be something appropriate (e.g., `20151_pushes`), and run it, creating two tables in the database
2. Duplicate `config.sample.php` into `config.php`, and change the config variables accordingly. `$secret` is meant to be shared with and only with GitHub, and is used to verify that a request to the recording script does indeed come from GitHub.
3. Serve the page, and setup student repos with this hook. The mass population script in [github_course_mgmt/org_mgmt](https://github.com/usc-cs/github_course_mgmt/tree/master/org_mgmt) takes care of this - make sure you change the [config variable `HOOK_URL`](https://github.com/usc-cs/github_course_mgmt/blob/master/org_mgmt/org_mgmt.py#L23) accordingly, though.

