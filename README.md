# CRUD
## Minha Biblioteca Virtual

Bem-vindo ao repositório da **Minha Biblioteca Virtual**!  
Este projeto foi desenvolvido para criar um sistema simples de gerenciamento de livros, onde os usuários podem **adicionar, editar, excluir** e **marcar livros como favoritos**.  
A aplicação utiliza **PHP** para o backend e **Bootstrap** para o layout da interface.

---

## Tecnologias Utilizadas:  
- **PHP** (para o backend)  
- **HTML** (para formatação do texto)  
- **CSS** (para o visual e gráfica)  
- **MySQL** (para o banco de dados)  
- **Bootstrap 5** (para o design responsivo)  
- **JavaScript** (para funcionalidades dinâmicas, como modo escuro e interação com o status de favoritos)  

---

## Descrição do Projeto:  
O objetivo deste projeto é fornecer uma plataforma para organizar e acompanhar sua coleção de livros.  
O usuário pode:  
- **Adicionar** um novo livro à biblioteca.  
- **Editar** informações dos livros.  
- **Excluir** livros.  
- **Marcar livros como favoritos**.  

Além disso, o projeto implementa um **modo escuro** que pode ser ativado ou desativado, e a preferência do usuário é salva no navegador.  

---


## Funcionalidades:  
✅ **Cadastro de livros**: O usuário pode adicionar livros à biblioteca com título, autor, gênero, ano de publicação e status.  
✅ **Edição de livros**: O usuário pode editar as informações de qualquer livro da lista.  
✅ **Exclusão de livros**: O usuário pode excluir livros da biblioteca.  
✅ **Marcação de favoritos**: O usuário pode marcar um livro como favorito e visualizá-lo com um ícone especial.  
✅ **Modo escuro**: O usuário pode alternar entre modo claro e modo escuro, e a configuração é armazenada no navegador.  

---

## Como Rodar  
> *Usei o XAMPP Control Panel v3.3.0 como servidor e banco de dados, ativando o MySQL.*  

1. **Clone este repositório:**  
    ```sh
   git clone https://github.com/BrendatMartins/CRUD.git

2. **Navegue até a pasta do projeto: (geralmente fica no disco local C)**
    ```sh 
    C:/xampp/htdocs/CRUD

3. **Configure o banco de dados no MySQL e crie uma tabela livros com a seguinte estrutura:**

    ```sql
    CREATE TABLE livros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        autor VARCHAR(255) NOT NULL,
        genero VARCHAR(100),
        ano_publicacao INT,
        status ENUM('Lido', 'Não Lido') DEFAULT 'Não Lido'
    );

4. **Ajuste o arquivo config.php para as configurações do seu banco de dados:**

    ```php
    <?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'library_manager';    

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        die('Erro de conexão: ' . mysqli_connect_error());
    }
    ?>

5. **Coloque todos os arquivos do projeto em uma pasta dentro do seu servidor web local** (por exemplo, htdocs no XAMPP).
- Acesse a URL do projeto pelo navegador 
    ```sh
    (http://localhost/nome-da-pasta).
- O sistema deve funcionar sem necessidade de instalação adicional, desde que o banco de dados esteja configurado corretamente.


## Estrutura do Projeto:
- 📂 **index.php:** Página inicial onde são listados os livros e exibidos os botões para adicionar, editar ou excluir livros.
- 📂 **add.php:** Página para adicionar um novo livro à biblioteca.
- 📂 **edit.php:** Página para editar os detalhes de um livro existente.
- 📂 **delete.php:** Página que exclui um livro da biblioteca.
- 📂 **favoritos.php:** Página que exibe os livros favoritos.
- 📂 **favorito.php:** Arquivo responsável por alterar o status de favorito de um livro.
- 📂 **config.php:** Arquivo com as configurações de conexão ao banco de dados.

### Espero que goste do meu projeto!