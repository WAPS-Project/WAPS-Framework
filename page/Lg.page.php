<form class="" method="post" target="_self">
  <div class="form-group">
    <label for="InputUsername">Username</label>
    <input type="text" name="username" class="form-control" id="UsernameInput" aria-describedby="usernameHelp" placeholder="Enter Username">
    <small id="usernameHelp" class="form-text text-muted">Wir werden niemals deine Daten mit jemandem teilen.</small>
  </div>
  <div class="form-group">
    <label for="InputPassword">Password</label>
    <input type="password" name="password" class="form-control" id="InputPassword" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="Check">
    <label class="form-check-label" for="Check"><a href="#">Nutzungsbedingungen</a> zustimmen.</label>
  </div>
  <button type="submit" class="btn btn-primary">Bestätigen</button>
</form>
<?php $aha = $_USR -> LoginUser($db_link); ?>
