<h1>Registration</h1>
<form class="formular" method="post" target="_parent">
    <div class="form-group">
        <label class="label" for="username">E-Mail</label>
        <input type="email" name="email" class="form-control input" id="InputEmail" aria-describedby="eMail"
               placeholder="Enter Email" required>
    </div>
    <div class="form-group">
        <label class="label" for="username">Username</label>
        <input type="text" name="username" class="form-control input" id="InputUsername" aria-describedby="userName"
               placeholder="Enter Username" required>
    </div>
    <div class="form-group">
        <label class="label" for="firstName">Vorname</label>
        <input type="text" name="firstName" class="form-control input" id="InputFirstName" aria-describedby="firstName"
               placeholder="Enter first Name" required>
    </div>
    <div class="form-group">
        <label class="label" for="lastName">Nachname</label>
        <input type="text" name="lastName" class="form-control input" id="InputLastName" aria-describedby="lastName"
               placeholder="Enter last Name" required>
    </div>
    <div class="form-group">
        <label class="label" for="age">Alter</label>
        <input type="number" name="age" class="form-control input" id="InputAge" aria-describedby="age"
               placeholder="Enter Age" required>
    </div>
    <div class="form-group">
        <label class="label" for="InputPassword">Password</label>
        <input type="password" name="pw" class="form-control input" id="InputPassword" placeholder="Enter Password"
               required>
        <small id="password" class="form-text text-muted">Bitte achte darauf, dass dein Passwort mindestens 10 Zeichen
            lang ist!</small>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input check" name="check" id="Check" required>
        <label class="label-small" class="form-check-label" for="Check">Ich bin mit den <a
                    href="index.php?pagename=Termsofuse">Nutzungsbedingungen</a> einverstanden!</label>
    </div>
    <button type="submit" class="btn btn-success button">Absenden</button>
</form>
