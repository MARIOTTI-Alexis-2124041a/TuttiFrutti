# used command documentation

For code this project we used a lot of commands (thanks to symfony and composer). Here is a list of the most used  and importants commands.
This documentation will help you to understand how we used them.

## Table of content

- [Symfony](#symfony)
  - [Security](#security)
  - [Doctrine](#doctrine)
- [Composer](#composer)
- [npm](#npm)

## Symfony

Symfony came with a lot of command to help us to create the project.

We used the following command to fast create all the controllers we used.
```bash
php bin/console make:controller
```

Obviously we used the `symfony server:start` command to start the server.

We used some symfony bundles that adds other commands. Like Security and Doctrine.

### Security

In this project we used the Security bundle of symfony to manage the users and the security of the application.

We used `composer require symfony/security-bundle` to add the bundle to the project.
And we used the `php bin/console make:user` command to create the user class.

The `php bin/console make:security:form-login` command allowed us to create the login form. And we created the associated controller with the `php bin/console make:controller Login` command.

To prevent brute force attack we added a rate limiter with the `symfony/rate-limiter` package. 
```bash
composer require symfony/rate-limiter
```
The security package also created a `/logout` route (for login out the user) when used the command to creating login form.


### Doctrine

We used the doctrine bundle to easily manage the database of the project. A ORM was needed to fast create and manage the database.
To create the database we used the `php bin/console doctrine:database:create` command.

And for create tables and manage the link between the database table and the symfony project, we used entities.

To create an entity we used the `php bin/console make:entity` command.
We created entities **Album**, **Music** and **Fruit**. **User** was automatically created with the Security command.

Once the entities were created, we had to make a migration to update the Database for looking like the entities structure.

Commands used to make the migration : 
```bash
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
When you make a migration, the command automatically create a migration file in the `web/migrations` folder. This file is a php class extends from `AbstractMigration` and contains all the SQL commands to update the database to this migration state.
So you can reuse an old migration to revert the database to this state.


To populate the database we use fixtures. We used the following commands : 

//TODO : add the command to create the fixtures
ALESSIO STP

## composer

We used composer to manage the project dependencies.
First, to create the project we used the `composer create-project symfony/skeleton my_project_name` command.


The commands which we used the most are `composer install` to install the project dependencies and `composer require <depencie name>` to add a dependence.

We used it with all the dependencies we used in the project, for example `composer require symfony/ux-turbo` to add the symfony turbo package.

## npm

We used npm to manage the node packages. Indeed, we used it with the webpack encore package to manage the javascript assets of the project.

We also used a lot the `npm install` command to install all JavaScript package added with composer.

### Install webpack encore

```bash
composer require symfony/webpack-encore-bundle
npm install
```

### Build assets

After installed the webpack encore package, there missing assets required for the good symfony fonctionning. So we used the following command to build run the node packages and build the assets.

```bash
npm run dev
```