<?php
     session_start();
      if(isset($_SESSION['erros'])){
      echo "<label class='dados' >".$_SESSION['erros']."</label>";
      }
    ?>
<head meta chasrset='utf-8'>
</head>
    Informe os dados para realizar o cadastro: 
 
  <form method='POST' action="cadastro_usuario.php">

      <label class="dados" >Nome:</label> 
      <input type = "text" name="nome">
      <br>

      <label class="dados">Cidade:</label>
      <input type = "text" name="cidade">
      <br>

      <label class="dados">Estado:</label>
      <input type = "text" name="estado">
      <br>

      <label class="dados">Telefone:</label>
      <input type = "text" name="telefone">
      <br>

      <label class="dados">Email:</label>
      <input type = "email" name="email" placeholder="Ex: fulano@email.com">
      <br>

      <label class="dados">Senha:</label>
      <input type = "password" name="senha" pattern=".{8,200}" placeholder="Mínimo 8 caracteres">
      <br>

      <button type='submit'>Cadastrar</button>
      <label  class="dados"></label>  
      <br>

    
    </form>
  </div>
  </div>

</body>

</html>

