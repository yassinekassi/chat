<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Login Form -->
    <?php if (isset($this->error)): ?>
      <div class="error">
        <?php echo $this->error; ?>
      </div>
    <?php endif ?>
    <form method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="password" id="password" class="fadeIn third" name="password2" placeholder="Repeat Password">
      <input type="submit" class="fadeIn fourth" value="S'inscrire">
    </form>
    <div id="formFooter">
      <a class="underlineHover" href="/user/login">Connexion</a>
    </div>

  </div>
</div>