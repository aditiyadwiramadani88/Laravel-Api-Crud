git clone https://github.com/aditiyadwiramadani88/Laravel-Api-Crud.git

<p>cd Laravel-Api-Crud  php artisan migrate
</p>

<h1>Register</h1>

<code> 
post method
http://exsample.com/api/register data = {
name : your name
email : your email
password : your password
}
<code>change role_id to 1 in the users table </p>

<h1>Login</h1>
<code> 
post method
http//:exsample.com/api/login data = {
email : your email
password : your password
}


</code>

<h2>Auth </h2>

<p>headers Authorization: token </p>
<h1>Read And Create</h1>
<code>
    method get and post 
    http://exsample.com/api/crud/list
    post {
        name: 
        price:
    }
</code>


<h1>Read Edit Delete</h1>

<code>

    method get put and delete
    http://exsample.com/api/crud/details/id
    put {
    name:
    price:
    }
</code>