<form class="formular" method="post">
  <div class="form-group">
    <label class="label" for="InputUsername">Username</label>
    <input type="text" name="username" class="form-control input" id="UsernameInput" aria-describedby="usernameHelp" placeholder="Enter Username" required>
    <small id="usernameHelp" class="form-text text-muted">Wir werden niemals deine Daten mit jemandem teilen.</small>
  </div>
  <div class="form-group">
    <label class="label" for="InputPassword">Password</label>
    <input type="password" name="password" class="form-control input" id="InputPassword" placeholder="Password" required>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input check" id="Check" required>
    <label class="label-small" class="form-check-label input" for="Check"><a href="#">Nutzungsbedingungen</a> zustimmen.</label>
  </div>
  <button type="submit" class="btn btn-primary button">Bestätigen</button>
</form>
<?php $aha = $_USR -> LoginUser($db_link); ?>
