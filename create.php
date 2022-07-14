<?php 
    include_once("./templates/header.php")
?>

    <div class="container">
        
        <?php include_once("./templates/backBtn.html");?>
        <h1>Criar contato</h1>

        <form id="create-form" action="<?=$BASE_URL?>config/process.php" method="POST">
            <input type="hidden" name="type" value="create">

            <div class="form-group">
                <label for="name">Nome do contato:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Insira o nome" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefone do contato:</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Insira o telefone" required>
            </div>

            <div class="form-group">
                <label for="observations">Observações do contato:</label>
                <textarea type="text" class="form-control" name="observations" id="observations" placeholder="Insira suas observações deste contato" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>


<?php 
    include_once("./templates/footer.php")
?>