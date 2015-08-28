# Shoes and Brands

##### An app for creating a list of shoe stores and shoe brands.

#### By Kelli Sommerdyke

## Description

Using a MySQL database, this app allows users to see the brands a store offers, and the stores which offer a particular brand.

## Setup

1. Clone repository from GitHub.
2. Run $ composer install in the terminal.
3. Setup mySQL databases. Instructions using MAMP as server:
  1. Enter $ /Applications/MAMP/Library/bin/mysql --host=localhost -uroot -proot
  2. Turn on servers in MAMP
  3. Access phpMyAdmin
  4. Import shoes.sql from the GitHub project folder and create copy named shoes_test.
4. In another tab in the terminal, run $ cd ~/Path/To/Project/Folder
5. In order to get into the web directory, run $ cd web
6. In order to start a PHP server, run $ php -S localhost:8000
7. Direct browser to localhost:8000
8. Organize those shoes!

## MySQL commands run in the terminal (from Epicodus)
1. mysql.server start
2. mysql -uroot -proot;
3. CREATE DATABASE shoes;
4. USE shoes;
5. CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));
6. CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));
7. CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);
8. CREATE DATABASE shoes_test;
9. USE shoes_test;
10. CREATE TABLE stores (id serial PRIMARY KEY, name VARCHAR (255));
11. CREATE TABLE brands (id serial PRIMARY KEY, name VARCHAR (255));
12. CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);

## Technologies Used

PHP, mySQL
This app uses the Silex framework to structure the app and Twig for the views.

### Legal

Copyright (c) 2015 Kelli Sommerdyke

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
