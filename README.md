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

<details><summary class="section-title">GET <code>/api/v1/dashboard</code> -> Get dashboard information</summary></details>

<details><summary class="section-title">GET <code>/api/v1/tasks</code> -> Get all tasks</summary></details>

<details><summary class="section-title">GET <code>/api/v1/tasks/{task_id}</code> -> Get a single task</summary></details>

<details><summary class="section-title">GET <code>/api/v1/projects</code> -> Get all projects</summary></details>

<details><summary class="section-title">GET <code>/api/v1/projects/{project_id}</code> -> Get a single project</summary></details>

<details><summary class="section-title">POST <code>/api/v1/projects/{project_id}/payments</code> -> Update payment history</summary>

<div class="collapsable-details">
<div class="json-object-array">
	<pre>{
&nbsp; "amount_received": amount,
&nbsp; "updated_by":"Name of user updating the payment history",
}</pre>
</div>
</div>
</details>

<details><summary class="section-title">POST <code>/api/v1/projects</code> -> Create a new project</summary>

<div class="collapsable-details">
<div class="json-object-array">
	<pre>{
&nbsp; "name": "project_name",
&nbsp; "description":"project_description",
&nbsp; "amount_received": "total amount received from client so far",
&nbsp; "amount_expected":"expected total amount for the project",
}</pre>
</div>
</div>
</details>

<details><summary class="section-title">POST <code>/api/v1/tasks</code> -> Create a new task</summary>

<div class="collapsable-details">
<div class="json-object-array">
	<pre>{
&nbsp; "name": "task_name",
&nbsp; "description":"task_description",
&nbsp; "project_id": "the ID of the project this task belongs to",
&nbsp; "status":"current status of the task ('pending', 'in-progress' or 'done')",
}</pre>
</div>
</div>
</details>

<details><summary class="section-title">PUT <code>/api/v1/projects/{project_id}</code> -> Update details of an existing project</summary>

<div class="collapsable-details">
<div class="json-object-array">
	<pre>{
&nbsp; "name": "project_name",
&nbsp; "description":"project_description",
&nbsp; "amount_expected":"expected total amount for the project",
}</pre>
</div>
</div>
</details>

<details><summary class="section-title">PUT <code>/api/v1/tasks/{task_id}</code> -> Update details of an existing task</summary>

<div class="collapsable-details">
<div class="json-object-array">
	<pre>{
&nbsp; "name": "task_name",
&nbsp; "description":"task_description",
&nbsp; "status":"status of the task ('pending', 'in-progress' or 'done')",
}</pre>
</div>
</div>
</details>

<details><summary class="section-title">DELETE <code>/api/v1/tasks/{task_id}</code> -> Delete an existing task</summary></details>

<details><summary class="section-title">DELETE <code>/api/v1/projects/{project_id}</code> -> Delete an existing project</summary></details>

### License

- **[MIT license](http://opensource.org/licenses/mit-license.php)**
- Copyright 2020 © <a href="https://tosinibrahim96.github.io/Resume/" target="_blank">Ibrahim Alausa</a>.
