let contadorMatriculas = 0;
function adicionarMatricula() {
  // Incrementa o contador de matrículas
  contadorMatriculas++;

  // Obtém o valor do campo de matrícula
  let matriculaValue = $(`#inputMatricula${contadorMatriculas}`).val();

  // Cria um novo elemento para exibir os dados
  let novoElemento = `<p>Matrícula ${contadorMatriculas}: ${matriculaValue}</p>`;

  // Adiciona o novo elemento ao contêiner de exibição
  $("#exibirDados").append(novoElemento);

  // Restante do seu código para adicionar novos campos
  let novoCampo = `
      <div>
          <div class="form-group">
              <span id="msgAlerta${contadorMatriculas}"></span>
              <label for="inputMatricula${contadorMatriculas}" class="form-label">Matrícula ${contadorMatriculas}</label>
              <input type="number" class="form-control" name="matricula${contadorMatriculas}" id="inputMatricula${contadorMatriculas}" placeholder="Digite a Matrícula">
              <br/>
              <button type="button" class="btn btn-danger" onclick="removerMatricula(${contadorMatriculas})">Remover</button>
          </div>
      </div>
  `;

  // Adiciona os novos campos ao contêiner
  $("#containerMatriculas").append(novoCampo);
}

function dadosAdicionados(){
      var matr = window.document.getElementById('inputMatricula${contadorMatriculas}');
      var res = window.document.getElementById('exibirDados');
      
      res.innerHTML = `${matr}`;
}

function removerMatricula(numeroMatricula) {
  // Remove o campo correspondente ao número de matrícula
  $(`#msgAlerta${numeroMatricula}`).remove();
  $(`#inputMatricula${numeroMatricula}`).parent().remove();
}
