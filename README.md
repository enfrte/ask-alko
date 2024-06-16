Demo: [https://codinginthecold.alwaysdata.net/ask-alko/src/](https://codinginthecold.alwaysdata.net/ask-alko/src/)

A queryable MySQL database ceated from Alko's Excel file database.

First run `composer install`

Fetch a new database: `cronJob.php` - Note check `CreateDB.php` for `$downloadExcelFile` being commented out. 

### What is Alko?

Alko is the national alcoholic beverage retailing monopoly in Finland. It is the only store in the country which retails beer over 5.5% ABV, wine (except in vineyards) and spirits (source: Wikipedia 2020).

### What is this project?

Alko's site has a pretty standard search feature where you can search by product name, and by category. This is fine for most people, but...they also have a downloadable guide (excel format) that has a lot more product information. I've converted this guide into a SQL database, and setup a query page where you can produce some very creative queries. For example, what's the cheapest beverage (euros per liter) with over 18% alcohol? What beverage has the least calories per liter? You get the idea. 

### Current status

* Download the excel database: done
* Rebuild the sql database tables: done
* Import data to the sql database: done
* Create a frontend to query the database: done

### Dev tips

There is a `cronJob.php` you can call to automate the fetching of new data.

### Made with 

PHP, HTMX, SQLite, Bootstrap 5, Twig, simplexlsx.
