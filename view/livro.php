<html>

<head>
    <?php 
        require("../def/head.php");
      require("../def/function.php");
      $connection = connection();
      
    ?>
    
    <script type="text/javascript" src="js/livro.js"></script>
</head>

<body class="bg-gradient-info">
    <div class="container-fluid no-gutters">

        <div class="row d-none d-sm-block d-md-none d-block d-sm-none" id="nav-sm">
                <div class="navbar row py-0 bg-secondary">
                    <div class="col" id="formulario" onclick="mudar_painel_form()">
                        <div class="nav btn btn-secondary row"><i class="fas fa-book-open px-5 py-1"></i>Formulário</div>
                    </div>

                    <div class="col" id="grade" onclick="mudar_painel_grid()">
                        <div class="nav btn btn-secondary row" ><i class="fas fa-th px-5 py-1"></i>Grade</div>
                    </div>
                </div>        
        </div>

        <div class="row ">
            <div id="painel-formulario" class="col border-right">
                <div class="navbar border-right-0 border-left-0 bg-secondary row ">
                    <button id="btn-novo" class="btn btn-primary" onclick="inserir_novo()" ><i class="fas fa-plus-circle"></i> Incluir Novo</button>
                    <button id="btn-gravar" class="btn btn-success" onclick="gravar()" ><i class="fas fa-check-circle"></i> Gravar</button>
                    <button id="btn-cancelar" class="btn btn-warning" onclick="cancelar()"><i class="fas fa-exclamation-triangle"></i> Cancelar</button>
                    <button id="btn-deletar" class="btn btn-danger" onclick="aparecermodal()"><i class="far fa-trash-alt"></i> Remover</button>
                </div>
                <form>
                    <div class="form-row my-4 ml-4">
                        <div class="form-group col-3 ">
                            <label for="idlivro">Id</label>
                            <input type="text" class="form-control" id="idlivro" placeholder="Id">
                        </div>
                        <div class="form-group col-5 offset-3">
                            <label for="inputCriadoEm">Criado Em</label>
                            <input type="text" class="form-control" id="inputCriadoEm" readonly>
                        </div>
                        <div class="form-group col-12 col-md-7">
                            <label for="nomelivro">Nome do livro</label>
                            <input type="text" class="form-control" id="nomelivro" placeholder="Nome do Livro">
                        </div>
                        <div class="form-group col-md-4 col-4 offset-0 offset-md-1">
                            <label for="preco">Preço</label>
                            <input autocomplete="off" type="text" class="form-control" id="preco" placeholder="Preço" >
                        </div>
                        <div class="form-group col-6 offset-2 offset-md-3">
                            <label for="biblioteca">Biblioteca</label>
                            <select class="form-control" id="biblioteca">
                                <option value=""></option>
                                <?php
                                $res = $connection->query("SELECT idbiblioteca, nome FROM biblioteca ORDER BY nome");
                                $arr = $res->fetchAll(2);
                                foreach($arr as $row){
                                    echo "<option value='{$row["idbiblioteca"]}'>{$row["nome"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col" id="painel-grade">
                <table class="table table-hover table-info table-striped py-0" id="grade">
                    <thead>
                        <tr class="bg-secondary">
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Biblioteca</th>
                            <th scope="col ">Preço</th>
                            <th scope="col" class="d-md-block d-none border-bottom">CriadoEm</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                        

                    </tbody>    
                </table>
            </div>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="caixa-msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-info">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar livro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> Deseja deletar esse livro? </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="deletar()" >Sim</button>
                    <button type="button" class="btn btn-danger"  data-dismiss="modal">Não</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-secondary">
            <div class="row col">
                <span class="text-muted col-md-6 col-7 offset-3 offset-md-5 ">Controle de livros de bibliotecas</span>
            </div>         
    </footer>

    <div id="sizes">
        <div class="d-none d-xl-block" >XL</div>
        <div class="d-none d-lg-block d-xl-none" >LG</div>
        <div class="d-none d-md-block d-lg-none" >MD</div>
        <div class="d-none d-sm-block d-md-none" >SM</div>
        <div class="d-block d-sm-none" >XS</div>
    </div>
</body>

</html>