
<div class="mx-wd auto">
    <div class="container">
        <form method="post" action="./files/insert.php" class="form_handle">
            <div class="header">
                <h1>Chat App</h1>
                <h2>User Sign Up</h2>
            </div>
            <div class="input-flex">
                <div class="input-control">
                    <label for="firstname">First Name</label>
                    <input type="text" placeholder="Enter First Name" name="fname">
                    <div class="error"></div>
                </div>
                <div class="input-control">
                    <label for="lastname">Last Name</label>
                    <input type="text" placeholder="Enter Last Name" name="lname">
                    <div class="error"></div>
                </div>
            </div>
            <div class="input-control">
                <label for="">User name</label>
                <input type="text" placeholder="Enter user name" name="uname">
                <div class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter password" name="pswd">
                <div class="error"></div>
            </div>
            <div class="btn">
                <input type="submit" value="Continue" name="create">
                <p>Already have an account? <a href="?ref=login">Login</a></p>
            </div>
        </form>
    </div>
</div>