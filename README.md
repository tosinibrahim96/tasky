# Tasky

> API implementation for the tasky application using Laravel


### Clone

- Clone the repository using `git clone https://github.com/tosinibrahim96/tasky.git`
- Create a `.env` file in the root folder and copy everything from `.env-sample` into it
- Fill the `.env` values with your Database details as required


### Setup

- Download WAMP or XAMPP to manage APACHE, MYSQL and PhpMyAdmin. This also installs PHP by default. You can follow [this ](https://youtu.be/h6DEDm7C37A)tutorial
- Download and install [composer ](https://getcomposer.org/)globally on your system

> install all project dependencies and generate application key

```shell
$ composer install
$ php artisan key:generate
```
> migrate all tables and seed required data into the database 

```shell
$ php artisan migrate:fresh --seed
```
> start your Apache server and MySQL on WAMP or XAMPP interface
> serve your project using the default laravel PORT or manually specify a PORT

```shell
$ php artisan serve (Default PORT)
$ php artisan serve --port={PORT_NUMBER} (setting a PORT manually)
```


### Available Endpoints

<details><summary class="section-title">GET <code>/api/v1/dashboard</code></summary></details>

<details><summary class="section-title">POST <code>/v1/projects/{project_id}/payments</code></summary>

<div class="collapsable-details">
<div class="json-object-array">
<ol>
	<li>
	<pre>{
&nbsp; "amount_received": amount,
&nbsp; "updated_by":"Name of user updating the payment history",
}</pre>
	</li>
   </ol>
</div>
</div>
</details>


### License

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © <a href="https://tosinibrahim96.github.io/Resume/" target="_blank">Ibrahim Alausa</a>.
